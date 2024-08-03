<?php

namespace App\AppPlugin\Crm\Tickets;

use App\AppCore\Menu\AdminMenu;


use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Tickets\Traits\CrmTicketsConfigTraits;
use App\Http\Controllers\AdminMainController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Yajra\DataTables\Facades\DataTables;


class CrmTicketFollowUpController extends AdminMainController {

    use CrmTicketsConfigTraits;


    function __construct() {
        parent::__construct();
        $this->controllerName = "TicketFollowUp";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
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
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;

        if (Route::currentRouteName() == $this->PrefixRoute . '.archived') {
            $route = '.DataTableArchived';
        } else {
            $route = '.DataTable';
        }

//        $session = self::getSessionData($request);
//        $rowData = self::TicketFilterQuery(self::indexQuery(), $session);

//      dd($rowData->first());

        return view('AppPlugin.CrmTickets.index_follow_up')->with([
            'pageData' => $pageData,
//            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {

        $table = "crm_ticket";
        $data = DB::table($table)
            ->where('state', 1)
            ->where('user_id','!=',null)
            ->leftJoin("crm_customers", function ($join) {
                $join->on('crm_ticket.customer_id', '=', 'crm_customers.id');
            })
            ->leftJoin("crm_customers_address", function ($join) {
                $join->on('crm_ticket.customer_id', '=', 'crm_customers_address.customer_id');
                $join->where('crm_customers_address.is_default', '=', '1');
            })
            ->leftJoin("data_area_translations", function ($join) {
                $join->on('data_area_translations.area_id', '=', 'crm_customers_address.area_id');
                $join->where('data_area_translations.locale', '=', 'ar');
            })
            ->leftJoin("config_data_translations", function ($join) {
                $join->on('crm_ticket.device_id', '=', 'config_data_translations.data_id');
                $join->where('config_data_translations.locale', '=', 'ar');
            })
            ->leftJoin("users", function ($join) {
                $join->on('crm_ticket.user_id', '=', 'users.id');
            })

//            ->Join($table_address, $table . '.id', '=', $table_address . '.customer_id')
//            ->where($table_address . '.is_default', true)
//            ->leftJoin("config_data_translations", function ($join) {
//                $join->on('crm_customers.evaluation_id', '=', 'config_data_translations.data_id');
//                $join->where('config_data_translations.locale', '=', 'ar');
//            })
            ->select("$table.id as id",
                "$table.follow_date  as date_follow",
                "$table.created_at  as date_add",
                "$table.notes_err  as notes_err",
                "$table.notes  as notes",
                "crm_customers.name  as customers_name",
                "crm_customers.mobile  as customers_mobile",
                "data_area_translations.name  as customers_area_name",
                "config_data_translations.name  as device_name",
                "users.name  as user_name",
            );
        return $data;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::TicketFilterQuery(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()

//            ->editColumn('name', function ($row) {
//                return $row->customer->name ;
//            })
//
//            ->editColumn('mobile', function ($row) {
//                return $row->customer->mobile ;
//            })
//
//            ->editColumn('area', function ($row) {
////                return  LoadConfigName($this->CashAreaList,$row->customer->address->first()->area_id)  ;
//                return  $row->customer->address->first()->area->name ;
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
            ->rawColumns(['Edit', "Delete", 'Profile', 'Flag']);
    }




//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||



//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function storeUpdate(CrmCustomersRequest $request, $id = 0) {
//        $saveData = CrmCustomers::findOrNew($id);
//        try {
//            DB::transaction(function () use ($request, $saveData) {
//
//                $saveData = self::saveDefField($saveData, $request);
//                $saveData->save();
//
//                if ($this->Config['addCountry']) {
//                    $addressId = intval($request->input('address_id'));
//                    if ($addressId == 0) {
//                        $saveAddress = new CrmCustomersAddress();
//                        $saveAddress->is_default = true;
//                        $saveAddress = self::saveAddressField($saveAddress, $saveData, $request);
//                        if ($saveAddress->country_id == null) {
//                            $saveAddress->country_id = Country::where('iso2', $request->input('countryCode_mobile'))->first()->id;
//                        }
//                        $saveAddress->save();
//                    } else {
//                        $saveAddress = CrmCustomersAddress::query()->where('id', $addressId)->firstOrFail();
//                        $saveAddress = self::saveAddressField($saveAddress, $saveData, $request);
//                        $saveAddress->save();
//                    }
//                }
//
//            });
//        } catch (\Exception $exception) {
//            return back()->with('data_not_save', "");
//        }
//
//        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
//    }
//
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
        $mainMenu->sel_routs = "admin.TicketFollowUp";
        $mainMenu->name = "admin/crm/ticket.app_menu";
        $mainMenu->icon = "fas fa-ticket-alt";
        $mainMenu->roleView = "crm_ticket_view";
        $mainMenu->save();


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketFollowUp.New";
        $subMenu->url = "admin.TicketFollowUp.New";
        $subMenu->name = "admin/crm/ticket.app_menu_new";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-eye";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketFollowUp.Today";
        $subMenu->url = "admin.TicketFollowUp.Today";
        $subMenu->name = "admin/crm/ticket.app_menu_today";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-bell";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketFollowUp.Back";
        $subMenu->url = "admin.TicketFollowUp.Back";
        $subMenu->name = "admin/crm/ticket.app_menu_back";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-thumbs-down";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketFollowUp.Next";
        $subMenu->url = "admin.TicketFollowUp.Next";
        $subMenu->name = "admin/crm/ticket.app_menu_next";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-history";
        $subMenu->save();

    }

}
