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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class CrmTicketOpenController extends AdminMainController {

    use CrmLeadsConfigTraits;
    use CrmMainTraits;
    use ReportFunTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "TicketOpen";
        $this->PrefixRole = 'crm_ticket';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);

        $this->config = self::defConfig();
        View::share('config', $this->config);

        $this->PageTitle = __('admin/crm_service_menu.ticket_open');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddButToCard' => false,
            'formName' => "CrmTicketOpenFilter",
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

        if ($RouteName == $this->PrefixRoute . '.All' or $RouteName == $this->PrefixRoute . '.filter') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_all');
            $pageData['IconPage'] = 'fa-eye';
            $RouteVal = "all";

        } elseif ($RouteName == $this->PrefixRoute . '.New') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_today');
            $pageData['IconPage'] = 'fa-eye';
            $RouteVal = "New";

        } elseif ($RouteName == $this->PrefixRoute . '.Today') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_today');
            $pageData['IconPage'] = 'fa-bell';
            $RouteVal = "Today";

        } elseif ($RouteName == $this->PrefixRoute . '.Back') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_back');
            $pageData['IconPage'] = 'fa-thumbs-down';
            $RouteVal = "Back";

        } elseif ($RouteName == $this->PrefixRoute . '.Next') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_next');
            $pageData['IconPage'] = 'fa-history';
            $RouteVal = "Next";
        }

        $rowData = self::DefLeadsFilterQuery(self::OpenTicketFilter($RouteVal, $this->PrefixRole), $session);
        $rowData = $rowData->get();


        return view('AppPlugin.CrmService.ticketOpen.index')->with([
            'pageData' => $pageData,
            'RouteVal' => $RouteVal,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function viewTicket(Request $request, $ticketId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $session = self::getSessionData($request);
        $Query = self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
        $ticket = $Query->where('id', $ticketId)->firstOrFail();


        return view('AppPlugin.CrmService.ticketOpen.view')->with([
            'pageData' => $pageData,
            'ticket' => $ticket,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request, $view) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::DefLeadsFilterQuery(self::OpenTicketFilter($view, $this->PrefixRole), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
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
                return LoadConfigName($this->DefCat['CrmServiceTicketState'], $row->follow_state);
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

        return view('AppPlugin.CrmService.ticketOpen.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'chartData' => $chartData,
            'rowData' => $rowData,
            'card' => $card,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.TicketOpen";
        $mainMenu->name = "admin/crm_service_menu.ticket_open";
        $mainMenu->icon = "fas fa-ticket-alt";
        $mainMenu->roleView = "crm_ticket_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "All|filter";
        $subMenu->url = "admin.TicketOpen.All";
        $subMenu->name = "admin/crm_service_menu.follow_list_all";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketOpen.New";
        $subMenu->url = "admin.TicketOpen.New";
        $subMenu->name = "admin/crm_service_menu.follow_list_new";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-eye";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketOpen.Today";
        $subMenu->url = "admin.TicketOpen.Today";
        $subMenu->name = "admin/crm_service_menu.follow_list_today";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-bell";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketOpen.Back";
        $subMenu->url = "admin.TicketOpen.Back";
        $subMenu->name = "admin/crm_service_menu.follow_list_back";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-thumbs-down";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketOpen.Next";
        $subMenu->url = "admin.TicketOpen.Next";
        $subMenu->name = "admin/crm_service_menu.follow_list_next";
        $subMenu->roleView = "crm_ticket_view";
        $subMenu->icon = "fas fa-history";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Report|filterReport";
        $subMenu->url = "admin.TicketOpen.Report";
        $subMenu->name = "admin/crm_service_menu.report";
        $subMenu->roleView = "crm_ticket_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();


    }


}
