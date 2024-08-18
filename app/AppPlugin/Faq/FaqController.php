<?php

namespace App\AppPlugin\Faq;

use App\AppPlugin\Faq\Models\Faq;
use App\AppPlugin\Faq\Models\FaqCategory;
use App\AppPlugin\Faq\Models\FaqPhoto;
use App\AppPlugin\Faq\Models\FaqPhotoTranslation;
use App\AppPlugin\Faq\Models\FaqTags;
use App\AppPlugin\Faq\Models\FaqTranslation;
use App\AppPlugin\Faq\Traits\FaqConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;

use App\Http\Requests\def\DefPostRequest;
use App\Http\Traits\CrudPostTraits;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class FaqController extends AdminMainController {

    use CrudTraits;
    use CrudPostTraits;
    use FaqConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "Question";
        $this->PrefixRole = 'Faq';
        $this->selMenu = "admin.Faq.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/faq.app_menu_faq');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new Faq();
        $this->translation = new FaqTranslation();
        $this->modelCategory = new FaqCategory();
        $this->modelPhoto = new FaqPhoto();
        $this->photoTranslation = new FaqPhotoTranslation();
        $this->modelTags = new FaqTags();

        $this->UploadDirIs = 'faq';
        $this->translationdb = 'faq_id';
        $this->modelPhotoColumn = 'faq_id';


        $this->PrefixTags = "admin.FaqTags";
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
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('CCCCCCCCCCCC');
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
