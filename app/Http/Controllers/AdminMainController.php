<?php

namespace App\Http\Controllers;

use App\AppCore\Menu\AdminMenuController;
use App\AppCore\UploadFilter\Models\UploadFilter;


use App\Helpers\AdminHelper;
use App\Helpers\MinifyTools;
use App\Helpers\photoUpload\PuzzleUploadProcess;

use App\Http\Requests\admin\ConfigModelUpdateRequest;
use App\Http\Traits\DefCategoryTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Spatie\Valuestore\Valuestore;
use Yajra\DataTables\Facades\DataTables;

class AdminMainController extends DefaultMainController {
    use DefCategoryTraits;

    public $modelSettings;
    public $StopeCash;

    public function __construct(
        $StopeCash = 0,
    ) {

        parent::__construct();
        $this->middleware('auth');

        $this->MinifyTools = new MinifyTools();
        $this->minType = "Seo";
        $this->reBuild = true;
        View::share('MinifyTools', $this->MinifyTools);
        View::share('minType', $this->minType);
        View::share('reBuild', $this->reBuild);

        $this->StopeCash = $StopeCash;

        View::share('filterTypes', UploadFilter::cash_UploadFilter());

        $modelsNameArr = [
            "users" => ['name' => __('admin/config/roles.menu_roles_users')],
            "roles" => ['name' => __('admin/config/roles.menu_roles_role')],
            "config" => ['name' => __('admin.app_menu_setting')],
            "data" => ['name' => __('admin.app_menu_data')],
            "leads" => ['name' => __('admin/leadsContactUs.app_menu')],
            "app_setting" => ['name' => __('admin/configApp.app_menu')],
            "Product" => ['name' => __('admin/proProduct.app_menu')],
            "Faq" => ['name' => __('admin/faq.app_menu')],
            "Blog" => ['name' => __('admin/blogPost.app_menu')],
            "FileManager" => ['name' => __('admin/fileManager.app_menu')],
            "orders" => ['name' => __('admin/orders.app_menu')],
            "customer" => ['name' => __('admin/customer.app_menu')],
            "Pages" => ['name' => __('admin/pages.app_menu')],
            "BlogPost" => ['name' => __('admin/model/blogPost.app_menu')],

            "Periodicals" => ['name' => __('admin/Periodicals.app_menu')],
            "crm_customer" => ['name' => __('admin/crm/customers.app_menu')],
            "crm_leads" => ['name' => __('admin/crm/leads.app_menu')],
            "crm_ticket" => ['name' => __('admin/crm/ticket.app_menu')],
            "crm_tech_follow" => ['name' => __('admin/crm/ticket.app_menu_teck_follow')],

        ];
        View::share('modelsNameArr', $modelsNameArr);
        View::share('Continent_Arr', $this->defCategory['ContinentArr']);
        View::share('filterTypeArr', $this->defCategory['FilterTypeArr']);
        View::share('PrintPhotoPosition', $this->defCategory['PrintPhotoPosition']);
        View::share('CustomersSearchType', $this->defCategory['CustomersSearchType']);
        View::share('WebSearchTypeArr', $this->defCategory['WebSearchTypeArr']);

        $modelSettings = Valuestore::make(config_path(config('app.model_settings_name')));
        $modelSettings = $modelSettings->all();
        $this->modelSettings = $modelSettings;
        View::share('modelSettings', $modelSettings);


        $this->DefCat = self::LoadCategory();
        View::share('DefCat', $this->DefCat);

        $this->CashConfigDataList = self::CashConfigDataList();
        View::share('CashConfigDataList', $this->CashConfigDataList);

        $this->CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $this->CashCountryList);

        $this->CashCityList = self::CashCityList();
        View::share('CashCityList', $this->CashCityList);

        $this->CashAreaList = self::CashAreaList();
        View::share('CashAreaList', $this->CashAreaList);

        $this->CashUsersList = self::CashUsersList();
        View::share('CashUsersList', $this->CashUsersList);

        $this->adminMenu = AdminMenuController::CashAdminMenu();
        View::share('adminMenu', $this->adminMenu);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function loadPagePermission($arr) {
        $defview = ['index', 'indexData'];
        $defcreate = ['create', 'createData'];
        $defedit = ['edit', 'editData'];
        $defdelete = ['destroy', 'ForceDeleteException'];

        $view = array_merge($defview, issetArr($arr, 'view', []));
        $create = array_merge($defcreate, issetArr($arr, 'create', []));
        $edit = array_merge($defedit, issetArr($arr, 'edit', []));
        $delete = array_merge($defdelete, issetArr($arr, 'delete', []));
        $sub = issetArr($arr, 'sub', null);

        $allPermission = array_merge($view, $create, $edit, $delete);

        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $create]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $delete]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => $allPermission]);
        if ($sub) {
            $this->middleware('permission:' . $sub, ['only' => $allPermission]);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function loadCategoryPermission($arr) {

        $defview = ['CategoryIndex'];
        $defcreate = ['CategoryCreate'];
        $defedit = ['CategoryEdit', 'emptyPhoto', 'CategoryConfig', 'emptyIcon', 'CategorySort'];
        $defdelete = ['DeleteLang', 'destroyException'];


        $view = array_merge($defview, issetArr($arr, 'view', []));
        $create = array_merge($defcreate, issetArr($arr, 'create', []));
        $edit = array_merge($defedit, issetArr($arr, 'edit', []));
        $delete = array_merge($defdelete, issetArr($arr, 'delete', []));
        $sub = issetArr($arr, 'sub', null);

        $allPermission = array_merge($view, $create, $edit, $delete);

        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $create]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $delete]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => $allPermission]);
        if ($sub) {
            $this->middleware('permission:' . $sub, ['only' => $allPermission]);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function loadConstructData($sendArr) {
        $this->configView = AdminHelper::arrIsset($sendArr, 'configView', null);
//        'configArr'=> ["datatable"=>1,"orderby"=>1,"orderbyPostion"=>1,"filterid"=>1,"morePhotoFilterid"=>1,"orderbyDate"=>1,"editor"=>1,"icon"=>1,]
//       'configArr'=> [ "filterid"=>1,"morePhotoFilterid"=>1 ,selectfilterid ]
        $this->configArr = AdminHelper::arrIsset($sendArr, 'configArr', array());

//        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['index', 'CategoryIndex']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => ['create', 'CategoryCreate']]);
//
//        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => [
//            'edit', 'updateStatus', 'emptyPhoto', 'editRoleToPermission',
//            'CategoryEdit', 'CategoryStoreUpdate', 'CategorySort', 'CategorySaveSort',
//            'TagsEdit', 'TagsConfig', 'TagsOnFly',
//        ]]);
//
//        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => ['destroy', 'destroyException']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_restore', ['only' => ['SoftDeletes', 'Restore', 'ForceDelete']]);

        $this->viewDataTable = AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_datatable', 0);
        View::share('viewDataTable', $this->viewDataTable);

        $this->viewEditor = AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_editor', 0);
        View::share('viewEditor', $this->viewEditor);

        $this->viewLabel = AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_label_view', 1);
        View::share('viewLabel', $this->viewLabel);


        $yajraTable = AdminHelper::arrIsset($sendArr, 'yajraTable', false);
        View::share('yajraTable', $yajraTable);

        $this->yajraPerPage = intval(AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_perpage', 10));
        if ($this->yajraPerPage == 0) {
            $this->yajraPerPage = 10;
        }
        View::share('yajraPerPage', $this->yajraPerPage);


        View::share('PrefixRoute', $this->PrefixRoute);
        View::share('PrefixRole', $this->PrefixRole);
        View::share('controllerName', $this->controllerName);
        View::share('PrefixCatRoute', $this->PrefixCatRoute ?? null);
        View::share('configArr', $this->configArr);
        View::share('PrintLocaleName', 'name_' . thisCurrentLocale());
        View::share('DefCategoryTextName', null);

        $this->formName = AdminHelper::arrIsset($sendArr, 'formName', null);
        View::share('formName', $this->formName);

        $pageData = AdminHelper::returnPageDate($sendArr);
        $this->pageData = $pageData;
        $this->yajraTable = $yajraTable;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function constructData($sendArr) {

        View::share('PrefixRoute', $this->PrefixRoute);
        View::share('PrefixRole', $this->PrefixRole);
        View::share('controllerName', $this->controllerName);
        View::share('PrefixCatRoute', $this->PrefixCatRoute ?? null);

        $this->formName = IsArr($sendArr, 'formName', null);
        View::share('formName', $this->formName);

        $this->yajraPerPage = IsArr($this->modelSettings, $this->controllerName . '_perpage', 10);
        View::share('yajraPerPage', $this->yajraPerPage);

        $this->configView = AdminHelper::arrIsset($sendArr, 'configView', null);
        $this->settings = AdminHelper::arrIsset($sendArr, 'settings', array());

        View::share('settings', $this->settings);
//        dd($this->settings);

        $pageData = AdminHelper::returnPageDate($sendArr);

        $this->pageData = $pageData;

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForgetSession(Request $request) {
        Session::forget($request->input('formName'));
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getSessionData($request) {
        if (isset($request->formName)) {
            $request->validate([
                'from_date' => 'nullable|date|date_format:Y-m-d',
                'to_date' => 'nullable|date|after_or_equal:from_date',
            ]);
            $session = Session::get($this->formName);
            if ($session) {
                if ($request->input('country_id')) {
                    if (issetArr($session, 'country_id', null) != $request->input('country_id')) {
                        $request['city_id'] = null;
                        $request['area_id'] = null;
                    }
                }
                if ($request->input('city_id')) {
                    if (issetArr($session, 'city_id', null) != $request->input('city_id')) {
                        $request['area_id'] = null;
                    }
                }
            }
            Session::put($this->formName, $request->all());
            Session::save();
        }
        $session = Session::get($this->formName);
        return $session;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getDefSetting($controllerName, $key, $def) {
        if (isset($this->modelSettings[$controllerName . $key])) {
            return $this->modelSettings[$controllerName . $key];
        } else {
            return $def;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getSelectQuery($query) {
        $controllerName = $this->controllerName;

        $perPage = self::getDefSetting($controllerName, '_perpage', '5');
        $dataTable = self::getDefSetting($controllerName, '_datatable', '0');
        $orderBy = self::getDefSetting($controllerName, '_orderby', '1');

        switch ($orderBy) {
            case 1:
                $query->orderBy('id', 'DESC');
                break;
            case 2:
                $query->orderBy('id', 'ASC');
                break;
            case 3:
                $query->orderByTranslation('name', 'DESC');
                break;
            case 4:
                $query->orderByTranslation('name', 'ASC');
                break;
            case 5:
                $query->orderBy('postion', 'ASC');
                break;
            case 6:
                $query->orderBy('created_at', 'DESC');
                break;
            case 7:
                $query->orderBy('created_at', 'ASC');
                break;
            default:
        }

        if ($dataTable == '1') {
            return $query->get();
        } else {
            return $query->paginate($perPage);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getAddLangForAdd() {
        if (Route::currentRouteName() == $this->PrefixRoute . '.create_ar') {
            $LangAdd = ['ar' => 'Arabic'];
        } elseif (Route::currentRouteName() == $this->PrefixRoute . '.create_en') {
            $LangAdd = ['en' => 'English'];
        } else {
            $LangAdd = config('app.web_lang');
        }
        return $LangAdd;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getAddLangForEdit($row) {
        $LangAdd = [];
        if (Route::currentRouteName() == $this->PrefixRoute . '.editAr') {
            $LangAdd = ['ar' => 'Arabic'];
        } elseif (Route::currentRouteName() == $this->PrefixRoute . '.editEn') {
            $LangAdd = ['en' => 'English'];
        } else {
            if (count(config('app.web_lang')) > 1) {
                foreach ($row->translations as $Lang) {
                    if ($Lang->locale == 'ar') {
                        $LangAdd += ['ar' => 'Arabic'];
                    }
                    if ($Lang->locale == 'en') {
                        $LangAdd += ['en' => 'English'];
                    }
                }
            } else {
                foreach (config('app.web_lang') as $key => $value) {
                    if ($key == 'ar') {
                        $LangAdd += ['ar' => 'Arabic'];
                    }
                    if ($key == 'en') {
                        $LangAdd += ['en' => 'English'];
                    }
                }
            }

        }
        return $LangAdd;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SaveAndUpdateDefPhoto($saveData, $request, $dir, $slug = "slug", $sendArr = array()) {

        $filterInputName = AdminHelper::arrIsset($sendArr, 'filter', 'filter_id');
        $setCountOfUpload = AdminHelper::arrIsset($sendArr, 'count', 2);
        $setfileUploadName = AdminHelper::arrIsset($sendArr, 'file', 'image');

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload($setCountOfUpload);
        $saveImgData->setUploadDirIs($dir . '/' . $saveData->id);
        $saveImgData->setnewFileName($request->input($slug));
        $saveImgData->setfileUploadName($setfileUploadName);
        $saveImgData->UploadOne($request, $filterInputName);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ConfigModelUpdate(ConfigModelUpdateRequest $request) {

        $model_id = $request->input('model_id') . "_";
        $PrefixRoute = $request->input('PrefixRoute') . ".index";

        $valuestore = Valuestore::make(config_path(config('app.model_settings_name')));
        foreach ($request->all() as $key => $value) {
            $valuestore->put($key, $value);
        }
        $valuestore->forget('_token');
        $valuestore->forget('B1');
        $valuestore->forget('model_id');

        if ($request->input('GoBack') !== null) {
            return redirect()->back()->with('Edit.Done', "");
        } else {
            if (Route::has($PrefixRoute)) {
                if ($request->input('ModelId') != null) {
                    return redirect(route($PrefixRoute, $request->input('ModelId')))->with('Edit.Done', "");
                } else {
                    return redirect(route($PrefixRoute))->with('Edit.Done', "");
                }
            } else {
                return redirect()->back()->with('Edit.Done', "");
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function redirectWhere($request, $id, $route) {
        if ($id == '0') {
            if ($request->input('AddNewSet') !== null) {
                return redirect()->back();
            } else {
                return redirect(route($route))->with('Add.Done', "");
            }
        } else {
            if ($request->input('GoBack') !== null) {
                return redirect()->back()->with('Edit.Done', "");
            } else {
                return redirect(route($route))->with('Edit.Done', "");
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function FormRequestSeo($id, $addLang, $table, $filedName, $rulesConfig) {

        foreach ($addLang as $key => $lang) {
            $rules[$key . ".name"] = 'required';

            if ($rulesConfig['des']) {
                $rules[$key . ".des"] = 'required';
            }
            if ($id == '0') {
                if ($rulesConfig['slug']) {
                    $rules[$key . ".slug"] = "required|unique:$table,slug";
                }
            } else {
                if ($rulesConfig['slug']) {
                    $rules[$key . ".slug"] = "required|unique:$table,slug,$id,$filedName,locale,$key";
                }
                if ($rulesConfig['seo']) {
                    $rules[$key . ".g_des"] = 'nullable';
                    $rules[$key . ".g_title"] = 'nullable';
                }
            }
        }
        return $rules;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function FormRequestDataSeo($id, $addLang, $seo, $table, $filedName) {
        foreach ($addLang as $key => $lang) {
            if ($id == '0') {
                $rules[$key . ".name"] = "required|unique:$table,name";
            } else {
                $rules[$key . ".name"] = "required|unique:$table,name,$id,$filedName,locale,$key";
            }

            if ($seo) {
                if ($id == '0') {
                    $rules[$key . ".slug"] = "required|unique:$table,slug";
                } else {
                    $rules[$key . ".slug"] = "required|unique:$table,slug,$id,$filedName,locale,$key";
                    $rules[$key . ".g_des"] = 'nullable';
                    $rules[$key . ".g_title"] = 'nullable';
                }
            }
        }
        return $rules;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function prepareSlug($data) {
        $addLang = json_decode($data['add_lang']);
        foreach ($addLang as $key => $lang) {
            if (isset($data[$key . '.slug'])) {
                data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
            }
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveTranslationMain($saveTranslation, $key, $request) {
        $saveTranslation->locale = $key;
        $saveTranslation->name = $request->input($key . '.name');
        $saveTranslation->des = $request->input($key . '.des');

        if (isset($request[$key]['g_title']) and $request->input($key . '.g_title') == null) {
            $saveTranslation->g_title = $request->input($key . '.name');
        } else {
            $saveTranslation->g_title = $request->input($key . '.g_title');
        }
        if (isset($request[$key]['g_des']) and $request->input($key . '.g_des') == null) {
            $saveTranslation->g_des = AdminHelper::seoDesClean($request->input($key . '.des'));
        } else {
            $saveTranslation->g_des = $request->input($key . '.g_des');
        }
        return $saveTranslation;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    static function FilterQ($query, $session, $order = null) {
//        $query->where('id', '!=', 0);
//
//        if (isset($session['from_date']) and $session['from_date'] != null) {
//            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
//        }
//
//        if (isset($session['to_date']) and $session['to_date'] != null) {
//            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
//        }
//
//        if (isset($session['country']) and $session['country'] != null) {
//            $query->where('country', $session['country']);
//        }
//
//        if (isset($session['project_id']) and $session['project_id'] != null) {
//            $query->where('project_id', $session['project_id']);
//        }
//
//        if (isset($session['is_active']) and $session['is_active'] != null) {
//            $query->where('is_active', $session['is_active']);
//        }
//
//        if (isset($session['country_id']) and $session['country_id'] != null) {
//            $query->where('country_id', $session['country_id']);
//        }
//
//        if ($order != null) {
//            $orderBy = explode("|", $order);
//            $query->orderBy($orderBy[0], $orderBy[1]);
//        }
//
//        return $query;
//    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # saveTranslation


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function redirectWhereNew($request, $id, $route) {
//        if ($id == '0') {
//            if ($request->input('AddNewSet') !== null) {
//                return redirect()->back();
//            } else {
//                return redirect($route)->with('Add.Done', "");
//            }
//        } else {
//            if ($request->input('GoBack') !== null) {
//                return redirect()->back()->with('Edit.Done', "");
//            } else {
//                return redirect($route)->with('Edit.Done', "");
//            }
//        }
//    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function DataTableAddColumns($data, $arr = array()) {
//
//        $viewPhoto = AdminHelper::arrIsset($arr, 'Photo', true);
//
//        return DataTables::eloquent($data)
//            ->addIndexColumn()
//            ->editColumn('tablename.0.name', function ($row) {
//                return $row->tablename[0]->name ?? '';
//            })
//            ->editColumn('tablename.1.name', function ($row) {
//                return $row->tablename[1]->name ?? '';
//            })
//            ->editColumn('arName', function ($row) {
//                return $row->arName->name ?? '';
//            })
//            ->editColumn('enName', function ($row) {
//                return $row->enName->name ?? '';
//            })
//            ->addColumn('photo', function ($row) use ($viewPhoto) {
//                if ($viewPhoto) {
//                    return TablePhoto($row);
//                }
//            })
//            ->addColumn('is_active', function ($row) {
//                return is_active($row->is_active);
//            })
//            ->addColumn('is_published', function ($row) {
//                return is_active($row->is_published);
//            })
//            ->editColumn('regular_price', function ($row) {
//                return number_format($row->regular_price);
//            })
//            ->editColumn('price', function ($row) {
//                return number_format($row->price);
//            })
//            ->editColumn('published_at', function ($row) {
//                return [
//                    'display' => date("Y-m-d", strtotime($row->published_at)),
//                    'timestamp' => strtotime($row->published_at)
//                ];
//            })
//            ->addColumn('Brand', function ($row) {
//                return $row->brand->name ?? '';
//            })
//            ->addColumn('CatName', function ($row) {
//                return view('datatable.but')->with(['btype' => 'CatName', 'row' => $row])->render();
//            })
//            ->addColumn('AddLang', function ($row) {
//                return view('datatable.but')->with(['btype' => 'addLang', 'row' => $row])->render();
//            })
//            ->addColumn('MorePhoto', function ($row) {
//                return view('datatable.but')->with(['btype' => 'MorePhoto', 'row' => $row])->render();
//            })
//            ->addColumn('Edit', function ($row) {
//                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
//            })
//            ->addColumn('Delete', function ($row) {
//                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
//            })
//            ->rawColumns(["photo", "is_active", "is_published", 'Edit', "Delete", 'MorePhoto', 'AddLang', 'OldPhotos', 'ViewListing', 'CatName']);
//    }

}
