<?php

namespace App\AppPlugin\Models\BlogPost;

use App\AppPlugin\Models\BlogPost\Models\Blog;
use App\AppPlugin\Models\BlogPost\Models\BlogCategory;
use App\AppPlugin\Models\BlogPost\Models\BlogPhoto;
use App\AppPlugin\Models\BlogPost\Models\BlogPhotoTranslation;
use App\AppPlugin\Models\BlogPost\Models\BlogReview;
use App\AppPlugin\Models\BlogPost\Models\BlogTags;
use App\AppPlugin\Models\BlogPost\Models\BlogTranslation;

use App\AppPlugin\Models\BlogPost\Traits\BlogConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;

use App\Http\Requests\def\DefPostRequest;
use App\Http\Traits\CrudPostTraits;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class BlogPostController extends AdminMainController {

    use CrudTraits;
    use CrudPostTraits;
    use BlogConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogPost";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_blog');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $this->model = new Blog();
        $this->translation = new BlogTranslation();
        $this->modelCategory = new BlogCategory();
        $this->modelPhoto = new BlogPhoto();
        $this->photoTranslation = new BlogPhotoTranslation();
        $this->modelTags = new BlogTags();
        $this->modelReview = new BlogReview();

        $this->UploadDirIs = 'blog';
        $this->modelPhotoColumn = 'blog_id';
        $this->translationdb = 'blog_id';

        $this->PrefixTags = "admin.BlogTags";
        View::share('PrefixTags', $this->PrefixTags);

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'settings' => getDefSettings($this->config, 'post'),
            'AddLang' => IsConfig($this->config, 'postAddOnlyLang', false),
            'restore' => 1,
        ];

        self::constructData($sendArr);
        self::loadPostPermission(array());

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashSidePopularTags');
        Cache::forget('CashSideBlogCategories');
        Cache::forget('CashBrandMenuList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostStoreUpdate(DefPostRequest $request, $id = 0) {
        return self::TraitsPostStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostForceDeleteException($id) {
        dd('hi');
        $deleteRow = $this->model::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
        if (count($deleteRow->more_photos) > 0) {
            foreach ($deleteRow->more_photos as $del_photo) {
                AdminHelper::DeleteAllPhotos($del_photo);
            }
        }
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        AdminHelper::DeleteDir($this->UploadDirIs, $id);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


}
