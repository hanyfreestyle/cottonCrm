<?php

namespace App\AppPlugin\Crm\CrmService\Tickets;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use App\AppPlugin\Crm\CrmService\Tickets\Traits\CrmDataTableTraits;
use App\AppPlugin\Data\Area\Models\Area;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class CrmTicketCashController extends AdminMainController {

    use CrmLeadsConfigTraits;
    use CrmMainTraits;
    use ReportFunTraits;
    use CrmDataTableTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "TicketCash";
        $this->PrefixRole = 'crm_service_cash';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";

        $this->config = self::defConfig();
        View::share('config', $this->config);

        $this->PageTitle = __('admin/crm_service_menu.ticket_cash');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'formName' => "CrmTicketCashFilter",
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

        $RouteName = Route::currentRouteName();


        if ($RouteName == $this->PrefixRoute . '.Cost') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.ticket_cash_cost');
            $pageData['IconPage'] = 'fas fa-car';
            $amount_type = "1";


        } elseif ($RouteName == $this->PrefixRoute . '.Deposit') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.ticket_cash_deposit');
            $pageData['IconPage'] = 'fas fa-random';
            $amount_type = "2";

        } elseif ($RouteName == $this->PrefixRoute . '.Service') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.ticket_cash_service');
            $pageData['IconPage'] = 'fas fa-eye';
            $amount_type = "3";
        }

        $rowData = CrmTicketsCash::defUnpaid()
            ->where('amount_type', $amount_type)
            ->orderBy('user_id')
            ->get()
            ->groupby('user_id');


        return view('AppPlugin.CrmService.ticketCash.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ConfirmPay($id) {
        $confirmPayment = CrmTicketsCash::defUnpaid()->where('id', $id)->firstOrFail();
        $confirmPayment->confirm_date = getCurrentTime();
        $confirmPayment->confirm_date_time = getCurrentTime();
        $confirmPayment->confirm_user_id = Auth::user()->id;
        $confirmPayment->amount_paid = $confirmPayment->amount;

//        dd($confirmPayment);
        $confirmPayment->save();

        if ($confirmPayment->amount_type == 1) {
            return redirect()->route($this->PrefixRoute . '.Cost',);
        } elseif ($confirmPayment->amount_type == 2) {
            return redirect()->route($this->PrefixRoute . '.Deposit',);
        } elseif ($confirmPayment->amount_type == 3) {
            return redirect()->route($this->PrefixRoute . '.Service',);
        } else {
            return redirect()->route($this->PrefixRoute . '.Service',);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DestroyPayment($id) {
        $destroyPayment = CrmTicketsCash::query()->where('id', $id)->firstOrFail();
        $destroyPayment->confirm_date = null;
        $destroyPayment->confirm_date_time = null;
        $destroyPayment->confirm_user_id = null;
        $destroyPayment->amount_paid = null;
        $destroyPayment->save();
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CashList(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __('admin/crm_service_menu.leads_distribution');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $Data = self::CashFilter(self::indexCashQuery(), $session);

        if ($session) {
            $rowData = $Data->get()->groupBy('confirm_date');
        } else {
            $today = Carbon::parse(now())->format("Y-m-d");
            $rowData = $Data->whereDate('confirm_date', $today)->get()->groupBy('confirm_date');
        }


        return view('AppPlugin.CrmService.ticketCash.cash_list')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexCashQuery() {
        $data = CrmTicketsCash::query()
            ->whereNotNull('amount_type')
            ->whereNotNull('confirm_date')
            ->whereNotNull('confirm_user_id')
            ->with('ticket')
            ->with('customer')
            ->with('user');
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashFilter($query, $session, $order = null) {

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('confirm_date', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('confirm_date', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if (isset($session['user_id']) and $session['user_id'] != null) {
            $query->where('user_id', $session['user_id']);
        }

        if (isset($session['amount_type']) and $session['amount_type'] != null) {
            $query->where('amount_type', $session['amount_type']);
        }


        return $query;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();

        $this->formName = "CrmTicketOpenReportFilter";
        View::share('formName', $this->formName);

//        $session = self::getSessionData($request);
//        $rowData = self::TicketFilter(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
//        $getData = $rowData->get();
//
//
//        $deviceId = $getData->groupBy('device_id')->toarray();
//        $userId = $getData->groupBy('user_id')->toarray();
//        $brandId = $getData->groupBy('brand_id')->toarray();
//        $area_id = $getData->groupBy('customer.address.0.area_id')->toarray();
//        $follow_state = $getData->groupBy('follow_state')->toarray();
//        $LeadSours = $getData->groupBy('sours_id')->toarray();
//        $LeadCategory = $getData->groupBy('ads_id')->toarray();
//
//
//        $AllData = $rowData->count();
//        $chartData['LeadSours'] = self::ChartDataFromDataConfig($AllData, 'LeadSours', $LeadSours);
//        $chartData['LeadCategory'] = self::ChartDataFromDataConfig($AllData, 'LeadCategory', $LeadCategory);
//        $chartData['Device'] = self::ChartDataFromDataConfig($AllData, 'DeviceType', $deviceId);
//        $chartData['BrandName'] = self::ChartDataFromDataConfig($AllData, 'BrandName', $brandId);
//        $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, $area_id);
//        $chartData['Users'] = self::ChartDataFromUsers($AllData, $userId);
//        $chartData['FollowState'] = self::ChartDataFromDefCategory($AllData, 'CrmServiceTicketState', $follow_state);
//



        $today = Carbon::parse(now())->format("Y-m-d");
        $now = Carbon::now();
        $startOfWeek = $now->startOfWeek(Carbon::SATURDAY)->format('Y-m-d');
        $endOfWeek = $now->endOfWeek(Carbon::THURSDAY)->format('Y-m-d');
        $currentMonth = $now->month;
        $currentYear = $now->year;

        $card['pay_today'] = self::indexCashQuery()->whereDate('confirm_date', $today)->sum('amount');
        $card['pay_week'] = self::indexCashQuery()->whereBetween('confirm_date', [$startOfWeek, $endOfWeek])->sum('amount');
        $card['pay_month'] = self::indexCashQuery()->whereMonth('confirm_date', $currentMonth)->whereYear('confirm_date', $currentYear)->sum('amount');
        $card['pay_un_piad'] = CrmTicketsCash::defUnpaid()->sum('amount');


        $monthChart = self::getCashChartMonth(self::indexCashQuery());
         View::share('monthChart', $monthChart);

        $yearChart = self::getCashChartYear(self::indexCashQuery());
        View::share('yearChart', $yearChart);


        return view('AppPlugin.CrmService.ticketCash.report')->with([
            'pageData' => $pageData,
            'card' => $card,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getCashChartMonth($Query,$filterFiled='confirm_date') {
        $allDayCount = 0;
        $dayList = "";
        $dayCountList = "";
        for ($i = 0; $i <= 30; $i++) {
            $queryClone = clone $Query;
            $day = Carbon::now()->subDay(30)->addDay($i);
            $count = $queryClone->whereDate($filterFiled, $day)->sum('amount');
            $allDayCount += $count;
            if ($i == 30) {
                $dayList .= "'" . date("dS", strtotime($day)) . "'";
                $dayCountList .= $count;
            } else {
                $dayList .= "'" . date("dS", strtotime($day)) . "'" . ",";
                $dayCountList .= $count . ",";
            }
        }
        return [
            'dayList' => $dayList,
            'dayCountList' => $dayCountList,
            'allDayCount' => $allDayCount,
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getCashChartYear($Query,$filterFiled='confirm_date') {
        $data = array();
        $allCount = 0;
        $monthList = "";
        $monthCountList = "";

        for ($i = 11; $i >= 0; $i--) {
            $queryClone = clone $Query;

            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');

            $count = $queryClone->whereMonth($filterFiled, $month)->whereYear($filterFiled, $year)->sum('amount');

            $allCount = $allCount + $count;

            if ($i == 0) {
                $monthList .= "'" . $month->shortMonthName . "'";
                $monthCountList .= $count;
            } else {
                $monthList .= "'" . $month->shortMonthName . "'" . ",";
                $monthCountList .= $count . ",";
            }

            array_push($data, array(
                'month' => $month->shortMonthName,
                'year' => $year,
                'count' => $count
            ));
        }

        return [
            'monthList' => $monthList,
            'monthCountList' => $monthCountList,
            'allCount' => $allCount,
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.TicketCash";
        $mainMenu->name = "admin/crm_service_menu.ticket_cash";
        $mainMenu->icon = "fas fa-dollar-sign";
        $mainMenu->roleView = "crm_service_cash_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketCash.Cost";
        $subMenu->url = "admin.TicketCash.Cost";
        $subMenu->name = "admin/crm_service_menu.ticket_cash_cost";
        $subMenu->roleView = "crm_service_cash_view";
        $subMenu->icon = "fas fa-car";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketCash.Deposit";
        $subMenu->url = "admin.TicketCash.Deposit";
        $subMenu->name = "admin/crm_service_menu.ticket_cash_deposit";
        $subMenu->roleView = "crm_service_cash_view";
        $subMenu->icon = "fas fa-random";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketCash.Service";
        $subMenu->url = "admin.TicketCash.Service";
        $subMenu->name = "admin/crm_service_menu.ticket_cash_service";
        $subMenu->roleView = "crm_service_cash_view";
        $subMenu->icon = "fas fa-eye";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketCash.CashList|TicketCash.filter";
        $subMenu->url = "admin.TicketCash.CashList";
        $subMenu->name = "admin/crm_service_menu.ticket_cash_list";
        $subMenu->roleView = "crm_service_cash_view";
        $subMenu->icon = "fas fa-file-invoice-dollar";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TicketCash.Report|TicketCash.filterReport";
        $subMenu->url = "admin.TicketCash.Report";
        $subMenu->name = "admin/crm_service_menu.report";
        $subMenu->roleView = "crm_service_cash_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }


}
