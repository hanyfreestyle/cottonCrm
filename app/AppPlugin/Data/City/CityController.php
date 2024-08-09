<?php

namespace App\AppPlugin\Data\City;


use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\City\Models\CityTranslation;
use App\AppPlugin\Data\City\Request\CityRequest;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\DbFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CityController extends AdminMainController {
    use CrudTraits;
    use DbFunTraits;
    use ConfigDataTraits;

    function __construct(City $model, CityTranslation $modelTranslation) {
        parent::__construct();
        $this->controllerName = "DataCity";
        $this->PrefixRole = 'data';
        $this->selMenu = "admin.data.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/dataCity";
        $this->PageTitle = __($this->defLang.'.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->UploadDirIs = "city";
        $this->model = $model;
        $this->modelTranslation = $modelTranslation;
        $this->translation_Filde = "city_id";

        $this->AppPluginConfig = config('AppPlugin.City');
        View::share('AppPluginConfig', $this->AppPluginConfig);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'configArr' => ["filterid" => 0, 'selectfilterid' => 0],
            'formName' => "CityFilter",
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
        $this->middleware('permission:city_view', ['only' => $Per_ViewAll]);

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
        $pageData['BoxH1'] = __($this->defLang.'.app_menu_list');


        $session = self::getSessionData($request);
        $rowData = self::ManageDataFilterQ(self::indexQuery(), $session);

        return view('AppPlugin.DataCity.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery() {
        $table = "data_city";
        $table_trans = "data_city_translations";
        $country_table = "data_country_translations";
        $data = DB::table($table)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.city_id')
            ->where($table_trans . '.locale', '=', self::defLang())
            ->Join($country_table, $table.'.country_id', '=', $country_table.'.country_id')
            ->where($country_table.'.locale', '=', self::defLang())
            ->select("$table.id as id",
                "$table.is_active as is_active",
                "$table_trans.name",
                "$country_table.name as country_name");
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
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang.'.app_menu_add');
        $rowData = $this->model::findOrNew(0);
        return view('AppPlugin.DataCity.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang.'.app_menu_edit');
        $rowData = $this->model::where('id', $id)->firstOrFail();
        return view('AppPlugin.DataCity.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(CityRequest $request, $id = 0) {
        $saveData = $this->model::findOrNew($id);

        try {
            DB::transaction(function () use ($request, $saveData) {
                $updateCountry = false;
                $saveData->is_active = intval((bool)$request->input('is_active'));
                if ($saveData->country_id != $request->input('country_id')) {
                    $updateCountry = true;
                }
                $saveData->country_id = $request->input('country_id');
                $saveData->save();

                if ($this->AppPluginConfig['add_photo']) {
                    self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');
                }
                self::saveTranslation($saveData, $request);
                if ($updateCountry) {
                    $updateArea = Area::where('city_id', $saveData->id)->get();
                    foreach ($updateArea as $area) {
                        $area->country_id = $request->input('country_id');
                        $area->save();
                    }
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForceDeleteException($id) {
        $deleteRow = $this->model::where('id', $id)->firstOrFail();
        try {
            DB::transaction(function () use ($deleteRow, $id) {
                $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                $deleteRow->forceDelete();
            });
        } catch (\Exception $exception) {
            return back()->with(['confirmException' => '', 'fromModel' => 'City', 'deleteRow' => $deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

}


