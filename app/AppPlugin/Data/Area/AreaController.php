<?php

namespace App\AppPlugin\Data\Area;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use App\AppPlugin\Data\Area\Request\AreaRequest;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\DbFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class AreaController extends AdminMainController {
    use CrudTraits;
    use DbFunTraits;
    use ConfigDataTraits;

    function __construct(Area $model, AreaTranslation $modelTranslation) {
        parent::__construct();
        $this->controllerName = "DataArea";
        $this->PrefixRole = 'data';
        $this->selMenu = "admin.data.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/dataArea";
        $this->PageTitle = __($this->defLang . '.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->UploadDirIs = "area";
        $this->model = $model;
        $this->modelTranslation = $modelTranslation;
        $this->translation_Filde = "area_id";

        $this->AppPluginConfig = config('AppPlugin.Area');
        View::share('AppPluginConfig', $this->AppPluginConfig);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'formName' => "AreaFilter",
        ];

        self::loadConstructData($sendArr);

        $Per_View = ['index'];
        $Per_Add = ['create'];
        $Per_Edit = ['edit'];
        $Per_Delete = ['ForceDeleteException'];
        $Per_ViewAll = array_merge($Per_View, $Per_Add, $Per_Edit, $Per_Delete);

        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $Per_Add]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $Per_Edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $Per_Delete]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => $Per_ViewAll]);
        $this->middleware('permission:area_view', ['only' => $Per_ViewAll]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('CashCityList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . '.app_menu_list');
        $session = self::getSessionData($request);
        $rowData = self::ManageDataFilterQ(self::indexQuery(), $session);
        return view('AppPlugin.DataArea.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery() {
        $table = "data_area";
        $table_trans = "data_area_translations";
        $country_table = "data_country_translations";
        $city_table = "data_city_translations";

        $data = DB::table($table)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.area_id')
            ->where($table_trans . '.locale', '=', self::defLang())
            ->Join($city_table, $table . '.city_id', '=', $city_table . '.city_id')
            ->where($city_table . '.locale', '=', self::defLang())
            ->Join($country_table, $table . '.country_id', '=', $country_table . '.country_id')
            ->where($country_table . '.locale', '=', self::defLang())
            ->select("$table.id as id",
                "$table.is_active as is_active",
                "$table_trans.name",
                "$country_table.name as country_name",
                "$city_table.name as city_name",
            );
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::ManageDataFilterQ(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function fetchCity(Request $request) {
        $data = City::where('country_id', $request->country_id)->with('translation')->get();
        return response()->json($data);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function fetchArea(Request $request) {
        $data = Area::where('city_id', $request->city_id)->with('translation')->get();
        return response()->json($data);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang . '.app_menu_add');
        $citylist = [];

        $rowData = $this->model::findOrNew(0);
        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            if (old('country_id') and File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
                $citylist = City::where('country_id', old('country_id'))->get();
            } else {
                $citylist = City::where('country_id', $this->AppPluginConfig['def_country'])->get();
            }
        } else {
            if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
                $citylist = City::all();
            }
        }

        return view('AppPlugin.DataArea.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'citylist' => $citylist,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . '.app_menu_edit');
        $rowData = $this->model::where('id', $id)->firstOrFail();
        $citylist = array();

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            if (old('country_id')) {
                $citylist = City::where('country_id', old('country_id'))->get();
            } else {
                $citylist = City::where('country_id', $rowData->country_id)->get();
            }
        } else {
            if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
                $citylist = City::all();
            }
        }

        return view('AppPlugin.DataArea.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'citylist' => $citylist,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(AreaRequest $request, $id = 0) {
        $saveData = $this->model::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->country_id = $request->input('country_id');
                $saveData->city_id = $request->input('city_id');
                $saveData->save();

                if ($this->AppPluginConfig['add_photo']) {
                    self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');
                }
                self::saveTranslation($saveData, $request);
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
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


}


