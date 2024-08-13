<?php

namespace App\AppPlugin\Data\ConfigData;

use App\Http\Controllers\AdminMainController;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\City\Models\CityTranslation;
use App\AppPlugin\Data\City\Request\CityRequest;
use App\AppPlugin\Data\Country\Country;
use App\Helpers\AdminHelper;

use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class ConfigDataController extends AdminMainController {
//    use CrudTraits;
//    use DataFunTraits;

    function __construct() {
        parent::__construct();
//        $this->controllerName = "DataCity";
//        $this->PrefixRole = 'data';
//        $this->selMenu = "admin.data.";
//        $this->PrefixCatRoute = "";
//        $this->PageTitle = __('admin/dataCity.app_menu');
//        $this->PrefixRoute = $this->selMenu . $this->controllerName;
//        $this->UploadDirIs = "city";
//        $this->model = $model;
//        $this->modelTranslation = $modelTranslation;
//        $this->translation_Filde = "city_id";
//        $this->AppPluginConfig = config('AppPlugin.City');
//
//        View::share('AppPluginConfig', $this->AppPluginConfig);
//        $sendArr = [
//            'TitlePage' => $this->PageTitle,
//            'PrefixRoute' => $this->PrefixRoute,
//            'PrefixRole' => $this->PrefixRole,
//            'AddConfig' => true,
//            'configArr' => ["filterid" => 1],
//            'yajraTable' => false,
//            'AddLang' => false,
//            'restore' => 0,
//            'formName' => "CityFilter",
//        ];
//
//        self::loadConstructData($sendArr);
//
//        if(File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
//            $CashCountryList = self::CashCountryList();
//            View::share('CashCountryList', $CashCountryList);
//        }

    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # ClearCash
//    public function ClearCash() {
//        Cache::forget('CashCityList');
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     index
//    public function index(Request $request) {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "List";
//        $pageData['SubView'] = false;
//
//        $session = self::getSessionData($request);
//
//        if($session == null) {
//            $rowData = self::getSelectQuery($this->model::def());
//        } else {
//            $rowData = self::getSelectQuery(self::ManageDataFilterQ($this->model::def(), $session));
//        }
//
//        return view('AppPlugin.DataCity.index')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//        ]);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     create
//    public function create() {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "Add";
//        $rowData = $this->model::findOrNew(0);
//        return view('AppPlugin.DataCity.form')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//        ]);
//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     edit
//    public function edit($id) {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "Edit";
//        $rowData = $this->model::where('id', $id)->firstOrFail();
//        return view('AppPlugin.DataCity.form')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//        ]);
//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
//    public function storeUpdate(CityRequest $request, $id = 0) {
//        $saveData = $this->model::findOrNew($id);
//
//        try {
//            DB::transaction(function () use ($request, $saveData) {
//                $updateCountry = false;
//                $saveData->is_active = intval((bool)$request->input('is_active'));
//                if($saveData->country_id != $request->input('country_id')){
//                    $updateCountry = true;
//                }
//                $saveData->country_id = $request->input('country_id');
//                $saveData->save();
//
//                if ($this->AppPluginConfig['add_photo']) {
//                    self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');
//                }
//                self::saveTranslation($saveData, $request);
//                if ($updateCountry){
//                    $updateArea = Area::where('city_id',$saveData->id)->get();
//                    foreach ($updateArea as $area){
//                        $area->country_id = $request->input('country_id');
//                        $area->save();
//                    }
//                }
//            });
//        } catch (\Exception $exception) {
//            return back()->with('data_not_save', "");
//        }
//        self::ClearCash();
//        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
//    }
//
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
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     Sort
//    public function Sort() {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "List";
//        $rowData = $this->model->orderBy('postion')->get();
//        return view('AppPlugin.DataCity.sort')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//        ]);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     sortByCountry
//    public function sortByCountry($country_id) {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "List";
//        $country = Country::where('id',$country_id)->firstOrFail();
//        $rowData = $this->model->where('country_id',$country_id)->orderBy('postion')->get();
//        return view('AppPlugin.DataCity.sort')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//            'country' => $country,
//        ]);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     SaveSort
//    public function SaveSort(Request $request) {
//        $positions = $request->positions;
//        foreach ($positions as $position) {
//            $id = $position[0];
//            $newPosition = $position[1];
//            $saveData = $this->model->findOrFail($id);
//            $saveData->postion = $newPosition;
//            $saveData->save();
//        }
//        self::ClearCash();
//        return response()->json(['success' => $positions]);
//    }

}


