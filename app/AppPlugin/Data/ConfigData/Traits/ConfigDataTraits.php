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
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $addLang = ['country' => ['id' => 'country', 'group' => 'admin', 'file_name' => 'dataCountry', 'name_en' => 'Country', 'name_ar' => 'الدول']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $addLang = ['city' => ['id' => 'city', 'group' => 'admin', 'file_name' => 'dataCity', 'name_en' => 'City', 'name_ar' => 'المدن']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $addLang = ['area' => ['id' => 'area', 'group' => 'admin', 'file_name' => 'dataArea', 'name_en' => 'Area', 'name_ar' => 'المناطق']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
                $addLang = ['LeadCategory' => ['id' => 'LeadCategory', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'LeadCategory', 'name_en' => 'LeadCategory', 'name_ar' => 'الحملات الاعلانية']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
                $addLang = ['LeadSours' => ['id' => 'LeadSours', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'LeadSours', 'name_en' => 'LeadSours', 'name_ar' => 'مصدر التواصل']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
                $addLang = ['BrandName' => ['id' => 'BrandName', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'BrandName', 'name_en' => 'BrandName', 'name_ar' => 'العلامات التجارية']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
                $addLang = ['DeviceType' => ['id' => 'DeviceType', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'DeviceType', 'name_en' => 'DeviceType', 'name_ar' => 'انواع الاجهزة']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
                $addLang = ['EvaluationCust' => ['id' => 'EvaluationCust', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'EvaluationCust', 'name_en' => 'Evaluation', 'name_ar' => 'تقييم العميل']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_BookRelease.php'))) {
                $addLang = ['BookRelease' => ['id' => 'BookRelease', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'BookRelease', 'name_en' => 'BookRelease', 'name_ar' => 'نوع الاصدار']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_BookLang.php'))) {
                $addLang = ['BookLang' => ['id' => 'BookLang', 'group' => 'admin', 'sub_dir' => 'data', 'file_name'
                => 'BookLang', 'name_en' => 'BookLang', 'name_ar' => 'اللغات']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
        $manageData = [
            ['cat_id' => 'data', 'name' => 'data_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'data', 'name' => 'data_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'data', 'name' => 'data_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'data', 'name' => 'data_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
        ];

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $newPer = [['cat_id' => 'data', 'name' => 'country_view', 'name_ar' => 'الدول', 'name_en' => 'Country']];
            $manageData = array_merge($manageData, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $newPer = [['cat_id' => 'data', 'name' => 'city_view', 'name_ar' => 'المدن', 'name_en' => 'City']];
            $manageData = array_merge($manageData, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $newPer = [['cat_id' => 'data', 'name' => 'area_view', 'name_ar' => 'المناطق', 'name_en' => 'Area']];
            $manageData = array_merge($manageData, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'LeadCategory_view', 'name_ar' => 'الحملة الاعلانية', 'name_en' => 'Lead Category']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'LeadSours_view', 'name_ar' => 'مصدر التواصل', 'name_en' => 'Lead Sours']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'BrandName_view', 'name_ar' => 'العلامة التجارية', 'name_en' => 'Brand Name']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'DeviceType_view', 'name_ar' => 'نوع الجهاز', 'name_en' => 'Device Type']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'EvaluationCust_view', 'name_ar' => 'تقييم العميل', 'name_en' => 'Evaluation']];
                $manageData = array_merge($manageData, $newPer);
            }

        }

        $data = array_merge($data, $manageData);

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.data";
        $mainMenu->name = "admin.app_menu_data";
        $mainMenu->icon = "fas fa-server";
        $mainMenu->roleView = "data_view";
        $mainMenu->postion = 81;
        $mainMenu->save();

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("Country");
            $subMenu->url = "admin.data.Country.index";
            $subMenu->name = "admin/dataCountry.app_menu";
            $subMenu->roleView = "country_view";
            $subMenu->icon = "fas fa-flag";
            $subMenu->save();
        }
        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("DataCity");
            $subMenu->url = "admin.data.DataCity.index";
            $subMenu->name = "admin/dataCity.app_menu";
            $subMenu->roleView = "city_view";
            $subMenu->icon = "fas fa-city";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("DataArea");
            $subMenu->url = "admin.data.DataArea.index";
            $subMenu->name = "admin/dataArea.app_menu";
            $subMenu->roleView = "area_view";
            $subMenu->icon = "fas fa-map-signs";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("EvaluationCust");
            $subMenu->url = "admin.data.EvaluationCust.index";
            $subMenu->name = "admin/data/EvaluationCust.app_menu";
            $subMenu->roleView = "EvaluationCust_view";
            $subMenu->icon = "fas fa-star";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("LeadCategory");
            $subMenu->url = "admin.data.LeadCategory.index";
            $subMenu->name = "admin/data/LeadCategory.app_menu";
            $subMenu->roleView = "LeadCategory_view";
            $subMenu->icon = "fas fa-bullhorn";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("LeadSours");
            $subMenu->url = "admin.data.LeadSours.index";
            $subMenu->name = "admin/data/LeadSours.app_menu";
            $subMenu->roleView = "LeadSours_view";
            $subMenu->icon = "fas fa-headset";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("BrandName");
            $subMenu->url = "admin.data.BrandName.index";
            $subMenu->name = "admin/data/BrandName.app_menu";
            $subMenu->roleView = "BrandName_view";
            $subMenu->icon = "far fa-copyright";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("DeviceType");
            $subMenu->url = "admin.data.DeviceType.index";
            $subMenu->name = "admin/data/DeviceType.app_menu";
            $subMenu->roleView = "DeviceType_view";
            $subMenu->icon = "fas fa-tv";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BookRelease.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("BookRelease");
            $subMenu->url = "admin.data.BookRelease.index";
            $subMenu->name = "admin/data/BookRelease.app_menu";
            $subMenu->roleView = "data_view";
            $subMenu->icon = "fas fa-book";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BookLang.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("BookLang");
            $subMenu->url = "admin.data.BookLang.index";
            $subMenu->name = "admin/data/BookLang.app_menu";
            $subMenu->roleView = "data_view";
            $subMenu->icon = "fas fa-globe";
            $subMenu->save();
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function selRouteList($Route) {
        return $Route . ".index|" . $Route . ".filter|" . $Route . ".create|" . $Route . ".edit|" . $Route . ".archived|" . $Route . ".config";
    }
}

