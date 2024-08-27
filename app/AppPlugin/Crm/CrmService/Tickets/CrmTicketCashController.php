<?php

namespace App\AppPlugin\Crm\CrmService\Tickets;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use App\AppPlugin\Crm\CrmService\Tickets\Traits\CrmDataTableTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
//        $this->defLang = "admin/crm/customers.";
//        View::share('defLang', $this->defLang);

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


        $session = self::getSessionData($request);
        $RouteName = Route::currentRouteName();

        if ($RouteName == $this->PrefixRoute . '.All' or $RouteName == $this->PrefixRoute . '.filter') {
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_all');
            $pageData['IconPage'] = 'fa-eye';

        } elseif ($RouteName == $this->PrefixRoute . '.Cost') {
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
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if (isset($session['follow_from']) and $session['follow_from'] != null) {
            $query->whereDate('follow_date', '>=', Carbon::createFromFormat('Y-m-d', $session['follow_from']));
        }

        if (isset($session['follow_to']) and $session['follow_to'] != null) {
            $query->whereDate('follow_date', '<=', Carbon::createFromFormat('Y-m-d', $session['follow_to']));
        }
        if (isset($session['user_id']) and $session['user_id'] != null) {
            $query->where('user_id', $session['user_id']);
        }
        if (isset($session['follow_state']) and $session['follow_state'] != null) {
            $query->where('follow_state', $session['follow_state']);
        }

        if (isset($session['sours_id']) and $session['sours_id'] != null) {
            $query->where('sours_id', $session['sours_id']);
        }
        if (isset($session['ads_id']) and $session['ads_id'] != null) {
            $query->where('ads_id', $session['ads_id']);
        }
        if (isset($session['device_id']) and $session['device_id'] != null) {
            $query->where('device_id', $session['device_id']);
        }
        if (isset($session['brand_id']) and $session['brand_id'] != null) {
            $query->where('brand_id', $session['brand_id']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $query->where('crm_customers_address.country_id', $session['city_id']);
        }

        if (isset($session['city_id']) and $session['city_id'] != null) {
            $query->where('crm_customers_address.city_id', $session['city_id']);
        }

        if (isset($session['area_id']) and $session['area_id'] != null) {
            $query->where('crm_customers_address.area_id', $session['area_id']);
        }

        return $query;
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
        $subMenu->sel_routs = "TicketCash.CashList";
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
