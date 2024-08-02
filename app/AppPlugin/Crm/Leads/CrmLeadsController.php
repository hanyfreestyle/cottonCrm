<?php

namespace App\AppPlugin\Crm\Leads;

use App\AppCore\Menu\AdminMenu;


use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use App\AppPlugin\Crm\Leads\Request\CreateTicketRequest;
use App\AppPlugin\Crm\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class CrmLeadsController extends AdminMainController {

    use CrmLeadsConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmLeads";
        $this->PrefixRole = 'crm_leads';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/leads.";
        View::share('defLang', $this->defLang);

        $this->Config = self::defConfig();
        View::share('Config', $this->Config);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddButToCard' => false,
            'configArr' => ["filterid" => 0, 'datatable' => 0, 'orderby' => 0],
            'yajraTable' => true,
            'AddLang' => false,
            'restore' => 0,
            'formName' => "CrmCustomersFilter",
        ];

        self::loadConstructData($sendArr);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AddNew() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
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
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "LeadsSearch";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $pageData['BoxH2'] = __($this->defLang . 'app_menu_search_results');
        $rowData = CrmCustomersController::CustomersSearchFilter($request);
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => true,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function addTicket($customerID) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;
        $customer = CrmCustomers::where('id', $customerID)->with('address')->firstOrFail();

        return view('AppPlugin.CrmLeads.form_add_ticket')->with([
            'pageData' => $pageData,
            'customer' => $customer,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CreateTicket(CreateTicketRequest $request, $customerID) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $customer = CrmCustomers::where('id', $customerID)->firstOrFail();
        try {
            DB::transaction(function () use ($request, $customer) {
                $saveData = new CrmTickets();
                $saveData->customer_id = $customer->id;
                $saveData->state = 1;
                $saveData->follow_state = 1;
                $saveData->follow_date = SaveDateFormat($request, 'follow_date');

                $saveData->sours_id = $request->input('sours_id');
                $saveData->ads_id = $request->input('ads_id');
                $saveData->device_id = $request->input('device_id');
                $saveData->brand_id = $request->input('brand_id');
                $saveData->save();
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return redirect()->route('admin.CrmLeads.addNew');
    }



//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    static function indexQuery() {
//
//        $table = "crm_customers";
//        $table_address = "crm_customers_address";
//        $dataTable = 'config_data_translations';
//        $data = DB::table($table)
//            ->Join($table_address, $table . '.id', '=', $table_address . '.customer_id')
//            ->where($table_address . '.is_default', true)
//            ->leftJoin("config_data_translations", function ($join) {
//                $join->on('crm_customers.evaluation_id', '=', 'config_data_translations.data_id');
//                $join->where('config_data_translations.locale', '=', 'ar');
//            })
//            ->select("$table.id as id",
//                "$table.name  as name",
//                "$table.mobile  as mobile",
//                "$table.mobile_code  as flag",
//                "$table.whatsapp  as whatsapp",
//                "$table.evaluation_id  as evaluation_id",
//                "$table_address.country_id as country_id",
//                "$table_address.city_id as city_id",
//                "$table_address.area_id as area_id",
//                "$dataTable.name as evaluation",
//            );
//        return $data;
//
//
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function DataTable(Request $request) {
//        if ($request->ajax()) {
//            $session = self::getSessionData($request);
//            $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);
//            return self::DataTableColumns($rowData)->make(true);
//        }
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function DataTableColumns($data, $arr = array()) {
//        return DataTables::query($data)
//            ->addIndexColumn()
//            ->editColumn('Flag', function ($row) {
//                return TablePhotoFlag_Code($row, 'flag');
//            })
//            ->editColumn('Profile', function ($row) {
//                return view('datatable.but')->with(['btype' => 'Profile', 'row' => $row])->render();
//            })
//            ->editColumn('Edit', function ($row) {
//                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
//            })
//            ->editColumn('Delete', function ($row) {
//                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
//            })
//            ->rawColumns(['Edit', "Delete", 'Profile', 'Flag']);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    static function CustomerDataFilterQ($query, $session, $order = null) {
//
//        if (isset($session['evaluation_id']) and $session['evaluation_id'] != null) {
//            $query->where('evaluation_id', $session['evaluation_id']);
//        }
//
//        if (isset($session['gender_id']) and $session['gender_id'] != null) {
//            $query->where('gender_id', $session['gender_id']);
//        }
//
//        if (isset($session['country_id']) and $session['country_id'] != null) {
//            $query->where('country_id', $session['country_id']);
//        }
//
//        if (isset($session['city_id']) and $session['city_id'] != null) {
//            $query->where('city_id', $session['city_id']);
//        }
//
//        if (isset($session['area_id']) and $session['area_id'] != null) {
//            $query->where('area_id', $session['area_id']);
//        }
//
//        return $query;
//    }
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function saveDefField($saveData, $request) {
//        $saveData->evaluation_id = $request->input('evaluation_id');
//        $saveData->gender_id = $request->input('gender_id');
//
//        $saveData->name = $request->input('name');
//        $saveData->mobile = $request->input('mobile');
//        $saveData->mobile_code = $request->input('countryCode_mobile');
//
//        $saveData->mobile_2 = $request->input('mobile_2');
//        if ($request->input('mobile_2')) {
//            $saveData->mobile_2_code = $request->input('countryCode_mobile_2');
//        }
//
//        $saveData->phone = $request->input('phone');
//        if ($request->input('phone')) {
//            $saveData->phone_code = $request->input('countryCode_phone');
//        }
//
//        $saveData->whatsapp = $request->input('whatsapp');
//        if ($request->input('whatsapp')) {
//            $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
//        }
//
//        $saveData->email = $request->input('email');
//        $saveData->notes = $request->input('notes');
//
//        return $saveData;
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function saveAddressField($saveAddress, $saveData, $request) {
//        $saveAddress->uuid = Str::uuid()->toString();
//        $saveAddress->customer_id = $saveData->id;
//
//        $saveAddress->country_id = $request->input('country_id');
//        $saveAddress->city_id = $request->input('city_id');
//        $saveAddress->area_id = $request->input('area_id');
//
//        $saveAddress->address = $request->input('address');
//        $saveAddress->floor = $request->input('floor');
//        $saveAddress->post_code = $request->input('post_code');
//        $saveAddress->unit_num = $request->input('unit_num');
//        $saveAddress->latitude = $request->input('latitude');
//        $saveAddress->longitude = $request->input('longitude');
//
//        return $saveAddress;
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function ForceDeleteException($id) {
//
////        $deleteRow = CrmCustomers::query()->where('id', $id)
////            ->firstOrFail();
////        $deleteRow->delete();
//
//
//        self::ClearCash();
//        return back()->with('confirmDelete', "");
//    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.CrmLeads";
        $mainMenu->name = "admin/crm/leads.app_menu";
        $mainMenu->icon = "fas fa-phone-volume";
        $mainMenu->roleView = "crm_leads_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.addNew|CrmLeads.searchFilter|CrmLeads.addTicket";
        $subMenu->url = "admin.CrmLeads.addNew";
        $subMenu->name = "admin/crm/leads.app_menu_add";
        $subMenu->roleView = "crm_leads_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "admin.CrmLeads.index";
        $subMenu->url = "admin.CrmLeads.index";
        $subMenu->name = "admin/crm/leads.app_menu_add_bulk";
        $subMenu->roleView = "crm_leads_view";
        $subMenu->icon = "fas fa-file-excel";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "admin.CrmLeads.index";
        $subMenu->url = "admin.CrmLeads.index";
        $subMenu->name = "admin/crm/leads.app_menu_distribution";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-random";
        $subMenu->save();

//        $subMenu = new AdminMenu();
//        $subMenu->parent_id = $mainMenu->id;
//        $subMenu->sel_routs = "CrmCustomer.Report.index|CrmCustomer.Report.filter";
//        $subMenu->url = "admin.CrmCustomer.Report.index";
//        $subMenu->name = "admin/crm/customers.app_menu_report";
//        $subMenu->roleView = "crm_customer_view";
//        $subMenu->icon = "fas fa-chart-pie";
//        $subMenu->save();

    }

}
