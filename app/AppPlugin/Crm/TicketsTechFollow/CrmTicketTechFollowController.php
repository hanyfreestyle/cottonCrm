<?php

namespace App\AppPlugin\Crm\TicketsTechFollow;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Tickets\Traits\CrmTicketsConfigTraits;
use App\Http\Controllers\AdminMainController;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class CrmTicketTechFollowController extends AdminMainController {
    use CrmTicketsConfigTraits;

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

        $session = self::getSessionData($request);
        $RouteName = Route::currentRouteName();

        if ($RouteName == $this->PrefixRoute . '.New') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_new');
            $RouteVal = "New";

        } elseif ($RouteName == $this->PrefixRoute . '.Today') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_today');
            $RouteVal = "Today";
        } elseif ($RouteName == $this->PrefixRoute . '.Back') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_back');
            $RouteVal = "Back";
        } elseif ($RouteName == $this->PrefixRoute . '.Next') {
            $pageData['TitlePage'] = __('admin/crm/ticket.app_menu_next');
            $RouteVal = "Next";
        }


        $rowData = self::TicketFilterQuery(self::indexQuery($RouteVal), $session);
        $rowData = $rowData->get();

        return view('AppPlugin.CrmTechFollow.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery($RouteVal) {

        if (Auth::user()->hasPermissionTo('crm_tech_follow_admin')) {
            $data = CrmTickets::query()->with('customer')->with('user')->where('state', 1);
        } else {
            if (Auth::user()->hasPermissionTo('crm_tech_follow_team_leader')) {
                $thisUserId = [Auth::user()->id];
                if (is_array(Auth::user()->crm_team)) {
                    $thisUserId = array_merge($thisUserId, Auth::user()->crm_team);
                }
                $data = CrmTickets::query()->where('state', 1)
                    ->WhereIn('user_id', $thisUserId);
//                dd($data->count());
            } else {
                $data = CrmTickets::query()->where('state', 1)->where('user_id', Auth::user()->id);
            }
        }

        if ($RouteVal == "New") {
            $data->where('follow_state', 1);
        } elseif ($RouteVal == 'Today') {
            $data->where('follow_date', '=', Carbon::today());
        } elseif ($RouteVal == 'Back') {
            $data->where('follow_date', '<', Carbon::today());
        } elseif ($RouteVal == 'Next') {
            $data->where('follow_date', '>', Carbon::today());
        }


        return $data;

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

    }

}
