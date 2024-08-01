<?php

namespace App\AppPlugin\Crm\Customers;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersRequest;

use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class CrmCustomersController extends AdminMainController {
    use CrudTraits;
    use CrmCustomersConfigTraits;


    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmCustomer";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);

        $this->Config = self::defConfig();
        View::share('Config', $this->Config);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $searchType = [
            ['id' => 1, 'name' => __('admin/crm/customers.search_type_1')],
            ['id' => 2, 'name' => __('admin/crm/customers.search_type_2')],
            ['id' => 3, 'name' => __('admin/crm/customers.search_type_3')],
        ];
        View::share('searchType', $searchType);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, 'datatable' => 0, 'orderby' => 0],
            'yajraTable' => true,
            'AddLang' => false,
            'restore' => 0,
            'formName' => "CrmCustomersFilter",
        ];

        self::loadConstructData($sendArr);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['search']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function repeat($value) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "repeat";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_repeat');

        $rowData = CrmCustomers::def()->where('mobile', $value)->orWhere('mobile_2', $value)
            ->orWhere('phone', $value)->orWhere('whatsapp', $value)->get();

        return view('AppPlugin.CrmCustomer.repeat')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);

        return view('AppPlugin.CrmCustomer.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_add');

        $rowData = CrmCustomers::findOrNew(0);
        $rowDataAddress = CrmCustomersAddress::query()->where('customer_id', 0)->firstOrNew();

        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'rowDataAddress' => $rowDataAddress,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $rowData = CrmCustomers::where('id', $id)->with('address')->firstOrFail();

        $rowDataAddress = CrmCustomersAddress::where('is_default', true)->where('customer_id', $rowData->id)->firstOrNew();

        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'rowDataAddress' => $rowDataAddress,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function profile($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = CrmCustomers::where('id', $id)->with('address')->firstOrFail();
        return view('AppPlugin.CrmCustomer.profile')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,

        ]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(CrmCustomersRequest $request, $id = 0) {
        $saveData = CrmCustomers::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {

                $saveData = self::saveDefField($saveData, $request);
                $saveData->save();

                if ($this->Config['addCountry']) {
                    $addressId = intval($request->input('address_id'));
                    if ($addressId == 0) {
                        $saveAddress = new CrmCustomersAddress();
                        $saveAddress->is_default = true;
                        $saveAddress = self::saveAddressField($saveAddress, $saveData, $request);
                        if ($saveAddress->country_id == null) {
                            $saveAddress->country_id = Country::where('iso2', $request->input('countryCode_mobile'))->first()->id;
                        }
                        $saveAddress->save();
                    } else {
                        $saveAddress = CrmCustomersAddress::query()->where('id', $addressId)->firstOrFail();
                        $saveAddress = self::saveAddressField($saveAddress, $saveData, $request);
                        $saveAddress->save();
                    }
                }

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {

        $table = "crm_customers";
        $table_address = "crm_customers_address";
        $dataTable = 'config_data_translations';
        $data = DB::table($table)
            ->Join($table_address, $table . '.id', '=', $table_address . '.customer_id')
            ->where($table_address . '.is_default', true)
            ->leftJoin("config_data_translations", function ($join) {
                $join->on('crm_customers.evaluation_id', '=', 'config_data_translations.data_id');
                $join->where('config_data_translations.locale', '=', 'ar');
            })
            ->select("$table.id as id",
                "$table.name  as name",
                "$table.mobile  as mobile",
                "$table.mobile_code  as flag",
                "$table.whatsapp  as whatsapp",
                "$table.evaluation_id  as evaluation_id",
                "$table_address.country_id as country_id",
                "$table_address.city_id as city_id",
                "$table_address.area_id as area_id",
                "$dataTable.name as evaluation",
            );
        return $data;


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('Flag', function ($row) {
                return TablePhotoFlag_Code($row, 'flag');
            })
            ->editColumn('Profile', function ($row) {
                return view('datatable.but')->with(['btype' => 'Profile', 'row' => $row])->render();
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'Profile', 'Flag']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CustomerDataFilterQ($query, $session, $order = null) {

        if (isset($session['evaluation_id']) and $session['evaluation_id'] != null) {
            $query->where('evaluation_id', $session['evaluation_id']);
        }

        if (isset($session['gender_id']) and $session['gender_id'] != null) {
            $query->where('gender_id', $session['gender_id']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $query->where('country_id', $session['country_id']);
        }

        if (isset($session['city_id']) and $session['city_id'] != null) {
            $query->where('city_id', $session['city_id']);
        }

        if (isset($session['area_id']) and $session['area_id'] != null) {
            $query->where('area_id', $session['area_id']);
        }

        return $query;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveDefField($saveData, $request) {
        $saveData->evaluation_id = $request->input('evaluation_id');
        $saveData->gender_id = $request->input('gender_id');

        $saveData->name = $request->input('name');
        $saveData->mobile = $request->input('mobile');
        $saveData->mobile_code = $request->input('countryCode_mobile');

        $saveData->mobile_2 = $request->input('mobile_2');
        if ($request->input('mobile_2')) {
            $saveData->mobile_2_code = $request->input('countryCode_mobile_2');
        }

        $saveData->phone = $request->input('phone');
        if ($request->input('phone')) {
            $saveData->phone_code = $request->input('countryCode_phone');
        }

        $saveData->whatsapp = $request->input('whatsapp');
        if ($request->input('whatsapp')) {
            $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
        }

        $saveData->email = $request->input('email');
        $saveData->notes = $request->input('notes');

        return $saveData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveAddressField($saveAddress, $saveData, $request) {
        $saveAddress->uuid = Str::uuid()->toString();
        $saveAddress->customer_id = $saveData->id;

        $saveAddress->country_id = $request->input('country_id');
        $saveAddress->city_id = $request->input('city_id');
        $saveAddress->area_id = $request->input('area_id');

        $saveAddress->address = $request->input('address');
        $saveAddress->floor = $request->input('floor');
        $saveAddress->post_code = $request->input('post_code');
        $saveAddress->unit_num = $request->input('unit_num');
        $saveAddress->latitude = $request->input('latitude');
        $saveAddress->longitude = $request->input('longitude');

        return $saveAddress;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForceDeleteException($id) {

//        $deleteRow = CrmCustomers::query()->where('id', $id)
//            ->firstOrFail();
//        $deleteRow->delete();


//        if ($deleteRow->orders_count == 0) {
//            try {
//                DB::transaction(function () use ($deleteRow, $id) {
//                    if (count($deleteRow->more_photos) > 0) {
//                        foreach ($deleteRow->more_photos as $del_photo) {
//                            AdminHelper::DeleteAllPhotos($del_photo);
//                        }
//                    }
//                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
//                    $deleteRow->forceDelete();
//                });
//            } catch (\Exception $exception) {
//                return back()->with(['confirmException' => '', 'fromModel' => 'Product', 'deleteRow' => $deleteRow]);
//            }
//        } else {
//            return back()->with(['confirmException' => '', 'fromModel' => 'Product', 'deleteRow' => $deleteRow]);
//        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function search() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $rowData = CrmCustomers::query()->where('id', 0)->get();
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => false,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function searchFilter(CrmCustomersSearchRequest $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $pageData['BoxH2'] = __($this->defLang . 'app_menu_search_results');

        if ($request->search_type == 1) {
            $rowData = CrmCustomers::query()
                ->where('mobile', $request->name)
                ->orWhere('mobile_2', $request->name)
                ->orWhere('phone', $request->name)
                ->orWhere('whatsapp', $request->name)
                ->get();
        } elseif ($request->search_type == 2) {
            $rowData = CrmCustomers::query()
                ->where('name', 'like', '%' . $request->name . '%')
                ->get();
        } elseif ($request->search_type == 3) {
            $searchString = $request->name;
            $rowData = CrmCustomers::query()->with('address')->whereHas('address', function ($query) use ($searchString) {
                $query->where('address', 'like', '%' . $searchString . '%');
            })->get();
        }

        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => true,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.CrmCustomer";
        $mainMenu->name = "admin/crm/customers.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "crm_customer_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("CrmCustomer");;
        $subMenu->url = "admin.CrmCustomer.index";
        $subMenu->name = "admin/crm/customers.app_menu_list";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.addNew";
        $subMenu->url = "admin.CrmCustomer.addNew";
        $subMenu->name = "admin/crm/customers.app_menu_add";
        $subMenu->roleView = "crm_customer_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.search|CrmCustomer.searchFilter";
        $subMenu->url = "admin.CrmCustomer.search";
        $subMenu->name = "admin/crm/customers.app_menu_search";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-search";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.Report.index|CrmCustomer.Report.filter";
        $subMenu->url = "admin.CrmCustomer.Report.index";
        $subMenu->name = "admin/crm/customers.app_menu_report";
        $subMenu->roleView = "crm_customer_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }

}
