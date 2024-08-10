<?php

namespace App\AppPlugin\Data\DataBrandName;

use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\View;

class DataBrandNameController extends AdminMainController {

    use ConfigDataTraits;

    function __construct(ConfigData $model, ConfigDataTranslation $modelTranslation) {
        parent::__construct();
        $this->controllerName = "BrandName";
        $this->cat_id = "BrandName";
        $this->PrefixRole = 'data';
        $this->selMenu = "admin.data.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/data/BrandName.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->modelTranslation = $modelTranslation;
        $this->translation_Filde = "data_id";

        $this->AppPluginConfig = config('AppPlugin.ConfigData');
        View::share('AppPluginConfig', $this->AppPluginConfig);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'formName' => $this->controllerName . "Filter",
        ];

        self::loadConstructData($sendArr);

        $permission = ['sub' => 'BrandName_view'];
        self::loadPagePermission($permission);

    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
//    public function ForceDeleteException($id) {
//        $deleteRow = $this->model::where('id', $id)->firstOrFail();
//        try {
//            DB::transaction(function () use ($deleteRow, $id) {
//                $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//                $deleteRow->forceDelete();
//            });
//        } catch (\Exception $exception) {
//            return back()->with(['confirmException' => '', 'fromModel' => 'City', 'deleteRow' => $deleteRow]);
//        }
//
//        self::ClearCash();
//        return back()->with('confirmDelete', "");
//    }
//
//


}


