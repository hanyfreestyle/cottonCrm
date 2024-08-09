<?php

namespace App\AppPlugin\Data\Country;

use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends AdminMainController {
    use CrudTraits;
    use ConfigDataTraits;

    function __construct(Country $model) {
        parent::__construct();
        $this->controllerName = "Country";
        $this->PrefixRole = 'data';
        $this->selMenu = "admin.data.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/dataCountry";
        $this->PageTitle = __($this->defLang . '.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->UploadDirIs = 'UploadDirIs';

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'configArr' => ["filterid" => 0],
            'formName' => "CountryFilter",
        ];
        self::loadConstructData($sendArr);


        $Per_View = ['index'];
        $Per_Add = ['create'];
        $Per_Edit = ['edit', 'updateStatus'];
        $Per_Delete = ['ForceDeleteException'];
        $Per_ViewAll = array_merge($Per_View, $Per_Add, $Per_Edit, $Per_Delete);

        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $Per_Add]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $Per_Edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $Per_Delete]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => $Per_ViewAll]);
        $this->middleware('permission:country_view', ['only' => $Per_ViewAll]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('CashCountryList');
        Cache::forget('CashOnlyCountries');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Country::onlyTrashed()->count() ;
        $pageData['BoxH1'] = __($this->defLang . '.app_menu_list');

        $session = self::getSessionData($request);
        $rowData = self::ManageDataFilterQ(self::indexQuery(), $session);

        return view('AppPlugin.DataCountry.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery() {
        $table = "data_countries";
        $table_trans = "data_country_translations";

        $data = DB::table($table)->where('deleted_at',null)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.country_id')
            ->where($table_trans . '.locale', '=', self::defLang())
            ->select("$table.id as id",
                "$table.photo_thum_1 as photo_thum_1",
                "$table.iso2 as iso2",
                "$table.iso3 as iso3",
                "$table.phone as phone",
                "$table.symbol as symbol",
                "$table.is_active as is_active",
                "$table_trans.name as name",
                "$table_trans.capital as capital",
                "$table_trans.continent as continent_name",
                "$table_trans.currency as currency",
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
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('Flag', function ($row) {
                return TablePhotoFlag($row);
            })
            ->editColumn('is_active', function ($row) {
                return is_active($row->is_active);
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'is_active', 'Flag']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = Country::findOrNew(0);
        return view('AppPlugin.DataCountry.form', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = Country::where('id', '=', $id)->firstOrFail();
        return view('AppPlugin.DataCountry.form', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(CountryRequest $request, $id = 0) {

        try {
            DB::transaction(function () use ($request, $id) {

                $saveData = Country::findOrNew($id);
                $saveData->iso2 = strtoupper($request->input('iso2'));
                $saveData->iso3 = strtoupper($request->input('iso3'));
                $saveData->fips = strtoupper($request->input('fips'));
                $saveData->iso_numeric = $request->input('iso_numeric');
                $saveData->phone = $request->input('phone');
                $saveData->symbol = $request->input('symbol');
                $saveData->currency_code = strtoupper($request->input('currency_code'));
                $saveData->continent_code = strtoupper($request->input('continent_code'));
                $saveData->language_codes = $request->input('language_codes');
                $saveData->top_level_domain = $request->input('top_level_domain');
                $saveData->time_zone = $request->input('time_zone');
                $saveData->area_km = $request->input('area_km');
                $saveData->save();

                foreach (config('app.admin_lang') as $key => $lang) {
                    $saveTranslation = CountryTranslation::where('country_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->capital = $request->input($key . '.capital');
                    $saveTranslation->currency = $request->input($key . '.currency');
                    $saveTranslation->continent = $request->input($key . '.continent');
                    $saveTranslation->nationality = $request->input($key . '.nationality');
                    if (config('AppPlugin.Country.seo')) {
                        $saveTranslation->g_title = $request->input($key . '.g_title');
                        $saveTranslation->g_des = $request->input($key . '.g_des');
                        $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    }
                    $saveTranslation->save();
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
        $deleteRow = Country::query()->where('id', $id)->firstOrFail();
        dd('ForceDeleteException');
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateStatus(Request $request) {
        $thisId = $request->send_id;
        $updateData = Country::findOrFail($thisId);
        if ($updateData->is_active == '1') {
            $updateData->is_active = '0';
        } else {
            $updateData->is_active = '1';
        }
        $updateData->save();
        self::ClearCash();
        return response()->json(['success' => $thisId]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function printName() {
        $Countries = Country::take(900)->get();
        $line = "[ ";
        foreach ($Countries as $country) {
            $line .= "[ ";
            $line .= '"' . $country->name . '", "' . strtolower($country->iso2) . '", "' . $country->phone . '"';
            if ($Countries->last() == $country) {
                $line .= "]";
            } else {
                $line .= " ],";
            }
        }
        $line .= " ]";
        return echobr($line);
    }


}


