<?php

namespace App\AppPlugin\Crm\TicketsTechFollow;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Tickets\Traits\CrmTicketsConfigTraits;
use App\AppPlugin\Data\Area\Models\Area;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class CrmTicketTechFollowController extends AdminMainController {
    use CrmTicketsConfigTraits;
    use ReportFunTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "TechFollowUp";
        $this->PrefixRole = 'crm_tech_follow';
        $this->selMenu = "admin.";

        $this->Config = self::defConfig();
        View::share('Config', $this->Config);

        $this->PageTitle = __('admin/crm/ticket.app_menu_teck_follow');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddButToCard' => false,
            'formName' => "CrmTechFollowUpFilter",
        ];

        self::loadConstructData($sendArr);


        $Per_Edit = ['ViewTicket'];
        $Per_report = ['Report'];
        $Per_view = ['index'];

        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $Per_Edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_report', ['only' => $Per_report]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => array_merge( $Per_view,$Per_Edit,$Per_report)]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

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

        $rowData = self::TicketFilterQuery(self::indexQuery_OpenTicket($RouteVal,$this->PrefixRole), $session);
        $rowData = $rowData->get();

        return view('AppPlugin.CrmTechFollow.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);

    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();

        $this->formName = "CrmDistributionReportFilter";
        View::share('formName', $this->formName);

        $session = self::getSessionData($request);
        $rowData = self::TicketFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
        $getData = $rowData->get();

        $deviceId = $getData->groupBy('device_id')->toarray();
        $userId = $getData->groupBy('user_id')->toarray();
        $brandId = $getData->groupBy('brand_id')->toarray();
        $area_id = $getData->groupBy('customer.address.0.area_id')->toarray();
        $follow_state = $getData->groupBy('follow_state')->toarray();

//      dd($follow_state);

        $AllData = $rowData->count();
        $chartData['Device'] = self::ChartDataFromDataConfig($AllData, 'DeviceType', $deviceId);
        $chartData['BrandName'] = self::ChartDataFromDataConfig($AllData, 'BrandName', $brandId);
        $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, $area_id);
        $chartData['Users'] = self::ChartDataFromUsers($AllData, $userId);
        $chartData['FollowState'] = self::ChartDataFromDefCategory($AllData, 'TicketState', $follow_state);

        $card = [];
        $card['all_count'] = $AllData;
        $card['today_count'] = self::CountData(self::TicketFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Today');
        $card['back_count'] = self::CountData(self::TicketFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Back');
        $card['next_count'] = self::CountData(self::TicketFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Next');

        return view('AppPlugin.CrmTechFollow.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'chartData' => $chartData,
            'rowData' => $rowData,
            'card' => $card,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CountData($data, $RouteVal) {
        if ($RouteVal == "Today") {
            $count = $data->where('follow_date', '=', Carbon::today())->count();
        } elseif ($RouteVal == 'Back') {
            $count = $data->where('follow_date', '<', Carbon::today())->count();
        } elseif ($RouteVal == 'Next') {
            $count = $data->where('follow_date', '>', Carbon::today())->count();
        }
        return $count;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.TechFollowUp";
        $mainMenu->name = "admin/crm/ticket.app_menu_teck_follow";
        $mainMenu->icon = "fas fa-tools";
        $mainMenu->roleView = "crm_tech_follow_view";
        $mainMenu->save();


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.New";
        $subMenu->url = "admin.TechFollowUp.New";
        $subMenu->name = "admin/crm/ticket.app_menu_new";
        $subMenu->roleView = "crm_tech_follow_view";
        $subMenu->icon = "fas fa-eye";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Today";
        $subMenu->url = "admin.TechFollowUp.Today";
        $subMenu->name = "admin/crm/ticket.app_menu_today";
        $subMenu->roleView = "crm_tech_follow_view";
        $subMenu->icon = "fas fa-bell";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Back";
        $subMenu->url = "admin.TechFollowUp.Back";
        $subMenu->name = "admin/crm/ticket.app_menu_back";
        $subMenu->roleView = "crm_tech_follow_view";
        $subMenu->icon = "fas fa-thumbs-down";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Next";
        $subMenu->url = "admin.TechFollowUp.Next";
        $subMenu->name = "admin/crm/ticket.app_menu_next";
        $subMenu->roleView = "crm_tech_follow_view";
        $subMenu->icon = "fas fa-history";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Report";
        $subMenu->url = "admin.TechFollowUp.Report";
        $subMenu->name = "admin/crm/ticket.app_menu_report";
        $subMenu->roleView = "crm_tech_follow_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();


    }

}
