<?php

namespace App\AppPlugin\Crm\CrmService\FollowUp;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\FollowUp\Request\UpdateTicketStatusRequest;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Data\Area\Models\Area;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class UserFollowUpController extends AdminMainController {
    use CrmLeadsConfigTraits;
    use CrmMainTraits;
    use ReportFunTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "TechFollowUp";
        $this->PrefixRole = 'crm_service_follow';
        $this->selMenu = "admin.";

        $this->config = self::defConfig();
        View::share('config', $this->config);

        $this->PageTitle = __('admin/crm_service_menu.report');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddButToCard' => false,
            'formName' => "CrmTechFollowUpFilter",
        ];

        self::constructData($sendArr);
        $per = [
            'view' => ['index'],
            'create' => [],
            'edit' => [],
            'report' => ['report'],
        ];
        self::loadPagePermission($per);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $session = self::getSessionData($request);
        $RouteName = Route::currentRouteName();

        if ($RouteName == $this->PrefixRoute . '.New') {
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

        return view('AppPlugin.CrmService.followUp.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateTicket($ticketId) {
        $pageData = $this->pageData;

        $pageData['ViewType'] = "List";
        $pageData['TitlePage'] = __('admin/crm_service_menu.follow_update');
        $ticket = [];
        try {
            $Query = self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), null);
            $ticket = $Query->where('id', $ticketId)->firstOrFail();
            $pageData['TitlePage'] .= " " . $ticket->id;
        } catch (\Exception $e) {
            self::abortAdminError(403);
        }

        $RouteName = Route::currentRouteName();
        $viewActionBut = false;
        $followState = null;

        if ($RouteName == $this->PrefixRoute . '.UpdateTicket') {
            $viewActionBut = true;
        } elseif ($RouteName == $this->PrefixRoute . '.UpdateFinished') {
            $followState = 2;
        } elseif ($RouteName == $this->PrefixRoute . '.UpdateDepends') {
            $followState = 3;
        } elseif ($RouteName == $this->PrefixRoute . '.UpdatePostponed') {
            $followState = 4;
        } elseif ($RouteName == $this->PrefixRoute . '.UpdateCancellation') {
            $followState = 5;
        } elseif ($RouteName == $this->PrefixRoute . '.UpdateReject') {
            $followState = 6;
        }

        return view('AppPlugin.CrmService.followUp.add_follow')->with([
            'pageData' => $pageData,
            'ticket' => $ticket,
            'viewActionBut' => $viewActionBut,
            'followState' => $followState,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateTicketStatus(UpdateTicketStatusRequest $request, $ticketId) {

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();


        $this->formName = "CrmUserFollowUp";
        View::share('formName', $this->formName);

        $session = self::getSessionData($request);
        $rowData = self::DefLeadsFilterQuery(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
        $getData = $rowData->get();

        $deviceId = $getData->groupBy('device_id')->toarray();
        $userId = $getData->groupBy('user_id')->toarray();
        $brandId = $getData->groupBy('brand_id')->toarray();
        $area_id = $getData->groupBy('customer.address.0.area_id')->toarray();
        $follow_state = $getData->groupBy('follow_state')->toarray();

        $AllData = $rowData->count();
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

        View::share('chartData', $chartData);
        View::share('session', $session);

        return view('AppPlugin.CrmService.followUp.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'card' => $card,
        ]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.TechFollowUp";
        $mainMenu->name = "admin/crm_service_menu.follow";
        $mainMenu->icon = "fas fa-tools";
        $mainMenu->roleView = "crm_service_follow_view";
        $mainMenu->save();


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.New";
        $subMenu->url = "admin.TechFollowUp.New";
        $subMenu->name = "admin/crm_service_menu.follow_list_new";
        $subMenu->roleView = "crm_service_follow_view";
        $subMenu->icon = "fas fa-eye";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Today";
        $subMenu->url = "admin.TechFollowUp.Today";
        $subMenu->name = "admin/crm_service_menu.follow_list_today";
        $subMenu->roleView = "crm_service_follow_view";
        $subMenu->icon = "fas fa-bell";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Back";
        $subMenu->url = "admin.TechFollowUp.Back";
        $subMenu->name = "admin/crm_service_menu.follow_list_back";
        $subMenu->roleView = "crm_service_follow_view";
        $subMenu->icon = "fas fa-thumbs-down";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Next";
        $subMenu->url = "admin.TechFollowUp.Next";
        $subMenu->name = "admin/crm_service_menu.follow_list_next";
        $subMenu->roleView = "crm_service_follow_view";
        $subMenu->icon = "fas fa-history";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "TechFollowUp.Report";
        $subMenu->url = "admin.TechFollowUp.Report";
        $subMenu->name = "admin/crm_service_menu.report";
        $subMenu->roleView = "crm_service_follow_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();


    }

}
