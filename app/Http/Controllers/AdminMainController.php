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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Spatie\Valuestore\Valuestore;


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
            "crm_customer" => ['name' => __('admin/crm_customer.app_menu')],
            "crm_service_leads" => ['name' => __('admin/crm_service_menu.leads')],
            "crm_service_follow" => ['name' => __('admin/crm_service_menu.follow')],
            "crm_service_open_ticket" => ['name' => __('admin/crm_service_menu.ticket_open')],


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
        $defview = ['index', 'indexData', 'report'];
        $defcreate = ['create', 'createData'];
        $defedit = ['edit', 'editData'];
        $defdelete = ['destroy', 'ForceDeleteException'];

        $view = array_merge($defview, issetArr($arr, 'view', []));
        $create = array_merge($defcreate, issetArr($arr, 'create', []));
        $edit = array_merge($defedit, issetArr($arr, 'edit', []));
        $delete = array_merge($defdelete, issetArr($arr, 'delete', []));
        $distribution = issetArr($arr, 'distribution', []);
        $report = issetArr($arr, 'report', []);
        $sub = issetArr($arr, 'sub', null);

        $allPermission = array_merge($view, $create, $edit, $delete, $distribution, $report);
        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $create]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $delete]);
        if (count($distribution) > 0) {
            $this->middleware('permission:' . $this->PrefixRole . '_distribution', ['only' => $distribution]);
        }
        if (count($report) > 0) {
            $this->middleware('permission:' . $this->PrefixRole . '_report', ['only' => $report]);
        }

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
    public function loadPostPermission($arr) {

        $defview = ['PostIndex', 'PostListCategory', 'ListMorePhoto', 'TagsIndex'];
        $defcreate = ['PostCreate', 'AddMorePhotos', 'TagsCreate'];
        $defedit = ['PostEdit', 'emptyPhoto', 'sortPhotoSave', 'emptyIcon', 'MorePhotosEdit', 'MorePhotosEditAll', 'TagsEdit', 'config'];
        $defdelete = ['destroy', 'DeleteLang', 'MorePhotosDestroy', 'MorePhotosDestroyAll', 'DeleteLang', 'TagsDelete'];
        $restore = ['PostSoftDeletes', 'Restore', 'PostForceDeleteException'];


        $view = array_merge($defview, issetArr($arr, 'view', []));
        $create = array_merge($defcreate, issetArr($arr, 'create', []));
        $edit = array_merge($defedit, issetArr($arr, 'edit', []));
        $delete = array_merge($defdelete, issetArr($arr, 'delete', []));

        $sub = issetArr($arr, 'sub', null);

        $allPermission = array_merge($view, $create, $edit, $delete, $restore);

        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $create]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $delete]);
        $this->middleware('permission:' . $this->PrefixRole . '_restore', ['only' => $restore]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => $allPermission]);
        if ($sub) {
            $this->middleware('permission:' . $sub, ['only' => $allPermission]);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function loadConstructData($sendArr) {
        View::share('PrefixRoute', $this->PrefixRoute);
        View::share('PrefixRole', $this->PrefixRole);
        View::share('controllerName', $this->controllerName);
        View::share('PrefixCatRoute', $this->PrefixCatRoute ?? null);
        View::share('PrintLocaleName', 'name_' . thisCurrentLocale());

        $this->configView = IsArr($sendArr, 'configView', null);

        $this->settings = IsArr($sendArr, 'settings', array());
        View::share('settings', $this->settings);

        $this->config = IsArr($sendArr, 'config', array());
        View::share('config', $this->config);

        $this->formName = IsArr($sendArr, 'formName', null);
        View::share('formName', $this->formName);

        $pageData = AdminHelper::returnPageDate($sendArr);
        $this->pageData = $pageData;

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

        $perPage = self::getDefSetting($controllerName, '_perpage', '15');
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
                $query->orderBy('position', 'ASC');
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
    public function abortAdminError($err) {
        if ($err == 403) {
            abort(403);
        }

    }


}
