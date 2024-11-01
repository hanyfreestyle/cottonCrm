<?php

namespace App\AppPlugin\Models\BlogPost;

use App\AppPlugin\Models\BlogPost\Models\BlogTags;
use App\AppPlugin\Models\BlogPost\Models\BlogTagsTranslation;
use App\AppPlugin\Models\BlogPost\Traits\BlogConfigTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefTagsRequest;
use App\Http\Traits\TagsTraits;
use Illuminate\Support\Facades\View;


class BlogTagsController extends AdminMainController {

    use TagsTraits;
    use BlogConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogTags";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_tags');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->tags = new BlogTags();
        $this->tagsTranslation = new BlogTagsTranslation();

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
        ];

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        self::ConstructData($sendArr);
        self::loadPostPermission(array());

        if (!$this->TableTags) {
            abort(403);
        }

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TagsStoreUpdate(DefTagsRequest $request, $id = 0) {
        return self::TraitsTagsStoreUpdate($request, $id);
    }

}
