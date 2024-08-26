<?php

namespace App\AppPlugin\Crm\CrmService\Tickets;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Data\Area\Models\Area;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class CrmTicketClosedController extends AdminMainController {

    use CrmLeadsConfigTraits;
    use CrmMainTraits;
    use ReportFunTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "TicketClose";
        $this->PrefixRole = 'crm_service_close_ticket';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
//        $this->defLang = "admin/crm/customers.";
//        View::share('defLang', $this->defLang);

        $this->config = self::defConfig();
        View::share('config', $this->config);

        $this->PageTitle = __('admin/crm_service_menu.ticket_close');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'formName' => "CrmTicketClosedFilter",
            'settings' => ['report' => true],
        ];

        self::constructData($sendArr);
        $per = [
            'view' => ['index'],
            'create' => [],
            'edit' => ['editTicket'],
            'delete' => ['destroy'],
            'report' => ['report'],
        ];
        self::loadPagePermission($per);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __('admin/crm.label_list_leads');


        $session = self::getSessionData($request);
        $RouteName = Route::currentRouteName();


//        dd(getDateDifference("2024-08-25 11:56:19", "2024-08-26 13:37:51"));

        if ($RouteName == $this->PrefixRoute . '.All' or $RouteName == $this->PrefixRoute . '.filter') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_all');
            $pageData['IconPage'] = 'fa-eye';
            $RouteVal = "all";

        } elseif ($RouteName == $this->PrefixRoute . '.Finished') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_today');
            $pageData['IconPage'] = 'fa-eye';
            $RouteVal = "Finished";

        } elseif ($RouteName == $this->PrefixRoute . '.Reject') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_today');
            $pageData['IconPage'] = 'fa-bell';
            $RouteVal = "Reject";

        } elseif ($RouteName == $this->PrefixRoute . '.Cancellation') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_back');
            $pageData['IconPage'] = 'fa-thumbs-down';
            $RouteVal = "Cancellation";
        }

        $rowData = self::DefLeadsFilterQuery(self::ClosedTicketFilter($RouteVal), $session);
        $rowData = $rowData->get();


        return view('AppPlugin.CrmService.ticketClosed.index')->with([
            'pageData' => $pageData,
            'RouteVal' => $RouteVal,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClosedTicketFilter() {

        $table = "crm_ticket";
        $table_customers = "crm_customers";
        $table_customers_address = "crm_customers_address";
        $table_user = 'users';
        $table_data = 'config_data_translations';
        $table_area_translations = 'data_area_translations';

        $data = DB::table($table)
            ->Join("$table_customers", $table . '.customer_id', '=', $table_customers . '.id')
            ->Join("$table_user", $table . '.user_id', '=', $table_user . '.id')

            ->leftJoin("$table_customers_address", function ($join) use ($table_customers_address,$table){
                $join->on($table.'.customer_id', '=', $table_customers_address.'.customer_id');
                $join->where($table_customers_address.'.is_default', '=', 1);
            })

            ->leftJoin("$table_data", function ($join) use ($table_data,$table){
                $join->on($table.'.device_id', '=', $table_data.'.data_id');
                $join->where($table_data.'.locale', '=', 'ar');
            })

            ->leftJoin("$table_area_translations", function ($join) use ($table_area_translations, $table_customers_address) {
                $join->on($table_customers_address . '.area_id', '=', $table_area_translations . '.area_id');
                $join->where($table_area_translations . '.locale', '=', 'ar');
            })


            ->select("$table.id as id",
                "$table.created_at  as created_at",
                "$table.close_date  as close_date",
                "$table.follow_state  as follow_state",
                "$table.notes_err  as notes_err",
                "$table.notes  as notes",
                "$table_customers.mobile  as customers_mobile",
                "$table_customers.name  as customers_name",
                "$table_user.name  as user_name",
                "$table_data.name  as device_name",
                "$table_customers_address.area_id  as area_id",
                "$table_area_translations.name  as area_name",
            );
        return $data;

    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function viewTicket(Request $request, $ticketId) {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "List";
//        $session = self::getSessionData($request);
//        $Query = self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
//        $ticket = $Query->where('id', $ticketId)->firstOrFail();
//
//
//        return view('AppPlugin.CrmService.ticketOpen.view')->with([
//            'pageData' => $pageData,
//            'ticket' => $ticket,
//        ]);
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request, $view) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::DefLeadsFilterQuery(self::ClosedTicketFilter($view), $session);
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
            ->editColumn('created_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->created_at)),
                    'timestamp' => strtotime($row->created_at)
                ];
            })
            ->editColumn('close_date', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->close_date)) . ' (' . getDateDifference($row->created_at, $row->close_date) . ')',
                    'timestamp' => strtotime($row->close_date)
                ];
            })
            ->editColumn('customers_name', function ($row) {
                return $row->customers_name;
            })
            ->editColumn('customers_mobile', function ($row) {
                return $row->customers_mobile;
            })
            ->editColumn('user_name', function ($row) {
                return $row->user_name;
            })
            ->editColumn('follow_state', function ($row) {
                return LoadConfigName($this->DefCat['CrmServiceTicketState'], $row->follow_state);
            })

//            ->editColumn('area', function ($row) {
//                return $row->customer->address->first()->area->name;
//            })
//            ->editColumn('device', function ($row) {
//                return $row->device_name->name;
//            })

            ->editColumn('viewTicket', function ($row) {
                return view('datatable.but')->with(['btype' => 'viewTicket', 'row' => $row])->render();
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
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();


        $this->formName = "CrmTicketOpenReportFilter";
        View::share('formName', $this->formName);

        $session = self::getSessionData($request);
        $rowData = self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
        $getData = $rowData->get();


        $deviceId = $getData->groupBy('device_id')->toarray();
        $userId = $getData->groupBy('user_id')->toarray();
        $brandId = $getData->groupBy('brand_id')->toarray();
        $area_id = $getData->groupBy('customer.address.0.area_id')->toarray();
        $follow_state = $getData->groupBy('follow_state')->toarray();
        $LeadSours = $getData->groupBy('sours_id')->toarray();
        $LeadCategory = $getData->groupBy('ads_id')->toarray();


        $AllData = $rowData->count();
        $chartData['LeadSours'] = self::ChartDataFromDataConfig($AllData, 'LeadSours', $LeadSours);
        $chartData['LeadCategory'] = self::ChartDataFromDataConfig($AllData, 'LeadCategory', $LeadCategory);
        $chartData['Device'] = self::ChartDataFromDataConfig($AllData, 'DeviceType', $deviceId);
        $chartData['BrandName'] = self::ChartDataFromDataConfig($AllData, 'BrandName', $brandId);
        $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, $area_id);
        $chartData['Users'] = self::ChartDataFromUsers($AllData, $userId);
        $chartData['FollowState'] = self::ChartDataFromDefCategory($AllData, 'CrmServiceTicketState', $follow_state);

        $card = [];
        $card['all_count'] = $AllData;
        $card['today_count'] = self::CountData(self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Today');
        $card['back_count'] = self::CountData(self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Back');
        $card['next_count'] = self::CountData(self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Next');

        $weekChart = self::getChartWeek($rowData);
        $monthChart = self::getChartMonth($rowData);
        View::share('chartData', $chartData);
        View::share('session', $session);
        View::share('weekChart', $weekChart);
        View::share('monthChart', $monthChart);

        return view('AppPlugin.CrmService.ticketOpen.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'rowData' => $rowData,
            'card' => $card,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.TicketClose";
        $mainMenu->name = "admin/crm_service_menu.ticket_close";
        $mainMenu->icon = "fas fa-times-circle";
        $mainMenu->roleView = "crm_service_close_ticket_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketClose.Finished";
        $subMenu->url = "admin.TicketClose.Finished";
        $subMenu->name = "admin/crm_service_menu.ticket_close_finished";
        $subMenu->roleView = "crm_service_close_ticket_view";
        $subMenu->icon = "fas fa-thumbs-up";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketClose.Cancellation";
        $subMenu->url = "admin.TicketClose.Cancellation";
        $subMenu->name = "admin/crm_service_menu.ticket_close_cancellation";
        $subMenu->roleView = "crm_service_close_ticket_view";
        $subMenu->icon = "fas fa-power-off";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketClose.Reject";
        $subMenu->url = "admin.TicketClose.Reject";
        $subMenu->name = "admin/crm_service_menu.ticket_close_reject";
        $subMenu->roleView = "crm_service_close_ticket_view";
        $subMenu->icon = "fas fa-thumbs-down";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketClose.Report|TicketClose.filterReport";
        $subMenu->url = "admin.TicketClose.Report";
        $subMenu->name = "admin/crm_service_menu.report";
        $subMenu->roleView = "crm_service_close_ticket_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function config() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if ($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }

}
