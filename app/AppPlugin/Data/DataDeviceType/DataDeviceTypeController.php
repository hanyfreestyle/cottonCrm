<?php

namespace App\AppPlugin\Data\DataDeviceType;

use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\View;

class DataDeviceTypeController extends AdminMainController {

    use ConfigDataTraits;

    function __construct(ConfigData $model, ConfigDataTranslation $modelTranslation) {
        parent::__construct();
        $this->controllerName = "DeviceType";
        $this->cat_id = "DeviceType";
        $this->PrefixRole = 'data';
        $this->selMenu = "admin.data.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/data/DeviceType.app_menu');
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
            'AddConfig' => true,
            'configArr' => ["filterid" => 0,'selectfilterid'=>0],
            'yajraTable' => true,
            'formName' => $this->controllerName."Filter",
        ];

        self::loadConstructData($sendArr);

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


