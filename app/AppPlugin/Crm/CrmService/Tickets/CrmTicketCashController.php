<?php

namespace App\AppPlugin\Crm\CrmService\Tickets;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use App\AppPlugin\Crm\CrmService\Tickets\Traits\CrmDataTableTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
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

        $rowData = CrmTicketsCash::query()
            ->where('amount_paid', null)
            ->where('confirm_date', null)
            ->where('pay_type', 1)
            ->where('amount_type', $amount_type)
            ->with('ticket')
            ->with('customer')
            ->with('user')
            ->orderBy('user_id')
            ->get();



//        dd($rowData->first());

        return view('AppPlugin.CrmService.ticketCash.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);

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
        $subMenu->sel_routs = "TicketCash.Report|TicketCash.filterReport";
        $subMenu->url = "admin.TicketCash.Report";
        $subMenu->name = "admin/crm_service_menu.report";
        $subMenu->roleView = "crm_service_cash_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }


}
