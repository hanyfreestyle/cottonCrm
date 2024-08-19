<?php

namespace App\AppPlugin\Data\ConfigData\Traits;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Data\ConfigData\Request\ConfigDataRequest;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\Facades\DataTables;


trait ConfigDataTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexData() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        if (Route::currentRouteName() == $this->PrefixRoute . '.archived') {
            $route = '.DataTableArchived';
        } else {
            $route = '.DataTable';
        }
        return view('AppPlugin.ConfigData.index', compact('pageData', 'route'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery() {
        $table = "config_data";
        $table_trans = "config_data_translations";

        $data = DB::table($table)
            ->where($table . '.cat_id', '=', $this->cat_id)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.data_id')
            ->where($table_trans . '.locale', '=', self::defLang())
            ->select("$table.id as id",
                "$table.is_active as is_active",
                "$table_trans.name",
            );
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    function defLang() {
        if (count(config('app.web_lang')) > 1) {
            $lang = LaravelLocalization::getCurrentLocale();
        } else {
            $lang = config('app.def_dataTableLang');
        }
        return $lang;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $data = self::indexQuery()->where('is_active', true);
            return self::DataTableColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableArchived(Request $request) {
        if ($request->ajax()) {
            $data = self::indexQuery()->where('is_active', false);
            return self::DataTableColumns($data)->make(true);
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
            ->editColumn('is_active', function ($row) {
                return is_active($row->is_active);
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'is_active']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function createData() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = $this->model::findOrNew(0);
        return view('AppPlugin.ConfigData.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editData($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->model::where('id', $id)->where('cat_id', $this->cat_id)->firstOrFail();
        return view('AppPlugin.ConfigData.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdateData(ConfigDataRequest $request, $id = 0) {
        $saveData = $this->model::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {

                $saveData->cat_id = $this->cat_id;
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = $this->modelTranslation::where('data_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->data_id = $saveData->id;
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->save();
                }
            });

        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearDataCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function ManageDataFilterQ($query, $session, $order = null) {
        $formName = issetArr($session, "formName", null);

        if (isset($session['is_active']) and $session['is_active'] != null) {
            $query->where('is_active', $session['is_active']);
        }

        if (isset($session['continent_code']) and $session['continent_code'] != null) {
            $query->where('continent_code', $session['continent_code']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            if ($formName == "CityFilter") {
                $query->where('data_city.country_id', $session['country_id']);
            }
            if ($formName == "AreaFilter") {
                $query->where('data_area.country_id', $session['country_id']);
            }
        }

        if (isset($session['city_id']) and $session['city_id'] != null) {
            if ($formName == "AreaFilter") {
                $query->where('data_area.city_id', $session['city_id']);
            }
        }

        if ($order != null) {
            $orderBy = explode("|", $order);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveTranslation($saveData, $request) {
        $fildeName = $this->translation_Filde;

        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = $this->modelTranslation::where($fildeName, $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->locale = $key;
            $saveTranslation->$fildeName = $saveData->id;
            $saveTranslation->name = $request->input($key . '.name');

            if ($this->AppPluginConfig['seo']) {
                if ($request->input($key . '.g_title') == null) {
                    $saveTranslation->g_title = $request->input($key . '.name');
                } else {
                    $saveTranslation->g_title = $request->input($key . '.g_title');
                }
                if ($request->input($key . '.g_des') == null) {
                    $saveTranslation->g_des = $request->input($key . '.name');
                } else {
                    $saveTranslation->g_des = $request->input($key . '.g_des');
                }
                $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
            }
            $saveTranslation->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function configData() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if ($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearDataCash() {
        Cache::forget('CashConfigDataList');
        Cache::forget('CashConfigData');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function selRouteList($Route) {
        return $Route . ".index|" . $Route . ".filter|" . $Route . ".create|" . $Route . ".edit|" . $Route . ".archived|" . $Route . ".config";
    }
}

