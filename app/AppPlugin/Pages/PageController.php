<?php

namespace App\AppPlugin\Pages;

use App\AppPlugin\Pages\Models\Page;
use App\AppPlugin\Pages\Models\PageCategory;
use App\AppPlugin\Pages\Models\PagePhoto;
use App\AppPlugin\Pages\Models\PagePhotoTranslation;
use App\AppPlugin\Pages\Models\PageTags;
use App\AppPlugin\Pages\Models\PageTranslation;
use App\AppPlugin\Pages\Traits\PageConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefPostRequest;
use App\Http\Traits\CrudPostTraits;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class PageController extends AdminMainController {

    use CrudTraits;
    use CrudPostTraits;
    use PageConfigTraits;

    protected $userId;

    function __construct() {
        parent::__construct();
        $this->controllerName = "PageList";
        $this->PrefixRole = 'Pages';
        $this->selMenu = "admin.Pages.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/pages.app_menu_page');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new Page();
        $this->translation = new PageTranslation();
        $this->modelCategory = new PageCategory();
        $this->modelPhoto = new PagePhoto();
        $this->photoTranslation = new PagePhotoTranslation();
        $this->modelTags = new PageTags();

        $this->UploadDirIs = 'pages';
        $this->translationdb = 'page_id';
        $this->modelPhotoColumn = 'page_id';

        $this->PrefixTags = "admin.PageTags";
        View::share('PrefixTags', $this->PrefixTags);



        $this->config = self::LoadConfig();
        View::share('config', $this->config);


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'settings' => getDefSettings($this->config, 'post'),
            'AddLang' => IsConfig($this->config, 'categoryAddOnlyLang', false),
            'restore' => 1,
        ];
        self::constructData($sendArr);

//        dd($this->config);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
public function ModelConfig(Request $request){

    $this->userId = $request->attributes->get('userId');
    dd($this->userId);
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('XXXXXXXXXXXXXXXXXXXX');
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
