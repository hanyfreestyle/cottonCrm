<?php

namespace App\AppPlugin\Crm\Tickets;

use App\AppCore\Menu\AdminMenu;

use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Tickets\Request\ChangeUserRequest;
use App\AppPlugin\Crm\Tickets\Traits\CrmTicketsConfigTraits;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class CrmTicketFollowUpController extends AdminMainController {

    use CrmTicketsConfigTraits;


    function __construct() {
        parent::__construct();
        $this->controllerName = "TicketFollowUp";
        $this->PrefixRole = 'crm_ticket';
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


        $session = self::getSessionData($request);
        $RouteName = Route::currentRouteName();

        if ($RouteName == $this->PrefixRoute . '.New') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_new');
            $pageData['IconPage'] = 'fa-eye';
            $RouteVal = "New";

        } elseif ($RouteName == $this->PrefixRoute . '.Today') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_today');
            $pageData['IconPage'] = 'fa-bell';
            $RouteVal = "Today";

        } elseif ($RouteName == $this->PrefixRoute . '.Back') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_back');
            $pageData['IconPage'] = 'fa-thumbs-down';
            $RouteVal = "Back";

        } elseif ($RouteName == $this->PrefixRoute . '.Next') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_next');
            $pageData['IconPage'] = 'fa-history';
            $RouteVal = "Next";
        }

        $rowData = self::TicketFilterQuery(self::indexQuery_OpenTicket($RouteVal, $this->PrefixRole), $session);
        $rowData = $rowData->get();


        return view('AppPlugin.CrmTickets.index_follow_up')->with([
            'pageData' => $pageData,
            'RouteVal' => $RouteVal,
//            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function viewTicket(Request $request, $ticketId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');

        $session = self::getSessionData($request);

        $Query = self::TicketFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
        $ticket = $Query->where('id', $ticketId)->firstOrFail();


        return view('AppPlugin.CrmTickets.view')->with([
            'pageData' => $pageData,
            'ticket' => $ticket,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request, $view) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
//            $rowData = self::TicketFilterQuery(self::indexQuery(), $session);
            $rowData = self::TicketFilterQuery(self::indexQuery_OpenTicket($view, $this->PrefixRole), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                if ($this->agent->isDesktop()) {
                    return $row->id;
                } else {
                    return null;
                }
            })
            ->editColumn('created_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->created_at)) . '' . TicketDateFrom($row->created_at) . '',
                    'timestamp' => strtotime($row->created_at)
                ];
            })
            ->editColumn('follow_date', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->follow_date)) . '' . TicketDateFrom($row->follow_date) . '',
                    'timestamp' => strtotime($row->follow_date)
                ];
            })
            ->editColumn('name', function ($row) {
                return $row->customer->name;
            })
            ->editColumn('mobile', function ($row) {
                return $row->customer->mobile;
            })
            ->editColumn('user_name', function ($row) {
                return $row->user->name;
            })
            ->editColumn('area', function ($row) {
                return $row->customer->address->first()->area->name;
            })
            ->editColumn('device', function ($row) {
                return $row->device_name->name;
            })
            ->editColumn('follow_state', function ($row) {
                return LoadConfigName($this->DefCat['TicketState'], $row->follow_state);
            })
            ->editColumn('viewTicket', function ($row) {
                return view('datatable.but')->with(['btype' => 'viewTicket', 'row' => $row])->render();
            })
            ->editColumn('changeUser', function ($row) {
                return view('datatable.but')->with(['btype' => 'changeUser', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->editColumn('viewInfo', function ($row) {
                return view('datatable.but')->with(['btype' => 'viewInfo', 'row' => $row])->render();
            })
            ->rawColumns(['viewTicket', "Delete", 'changeUser', 'viewInfo', 'follow_date']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function changeUser($id) {
        $previous = Route::getRoutes()->match(request()->create(url()->previousPath()))->getName();
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __('admin/crm/ticket.fr_change_but');
        $rowData = CrmTickets::defOpen()->where('id', $id)->firstOrFail();
        return view('AppPlugin.CrmTickets.form_change_user')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'previous' => $previous,
        ]);

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function changeUserUpdate(Request $request, $id) {

        $saveData = CrmTickets::defOpen()->where('id', $id)->firstOrFail();
        $saveData->user_id = $request->input('user_id');

        if (intval($request->input('user_id')) != 0) {
            $saveData->save();
        }

        if ($this->agent->isDesktop()) {
            return back()->with('confirmDelete', "");
        } else {
            if ($saveData->follow_date == Carbon::today()) {
                return redirect()->route($this->PrefixRoute . '.Today');
            } elseif ($saveData->follow_date < Carbon::today()) {
                return redirect()->route($this->PrefixRoute . '.Back');
            } elseif ($saveData->follow_date > Carbon::today()) {
                return redirect()->route($this->PrefixRoute . '.Next');
            } else {
                return back()->with('confirmDelete', "");
            }
        }


    }


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

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery_DataTable() {
        $table = "crm_ticket";
        $data = DB::table($table)
            ->where('state', 1)
            ->where('user_id', '!=', null)
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


}
