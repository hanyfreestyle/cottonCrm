<?php

namespace App\AppPlugin\Crm\CrmService\FollowUp;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\FollowUp\Request\UpdateTicketStatusRequest;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsDes;
use App\AppPlugin\Crm\CrmService\Tickets\Traits\CrmDataTableTraits;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Data\Area\Models\Area;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class UserFollowUpController extends AdminMainController {
    use CrmLeadsConfigTraits;
    use CrmMainTraits;
    use ReportFunTraits;
    use CrmDataTableTraits;

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
            'edit' => ['UpdateTicket', 'UpdateTicketStatus', 'UpdateTicketTable', 'AddTicketsDes', 'AddPayCash'],
            'report' => ['Report'],
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
            $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_new');
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

        $rowData = self::TicketFilter(self::OpenTicketFollowUpQuery($RouteVal, $this->PrefixRole), $session);
        $rowData = $rowData->get();

        return view('AppPlugin.CrmService.followUp.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AmountList() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['IconPage'] = 'fas fa-hand-holding-usd';
        $pageData['TitlePage'] = __('admin/crm_service_menu.follow_list_amount');

        $rowData = CrmTicketsCash::defUnpaid()
            ->where('user_id', Auth::user()->id)
            ->orderBy('user_id')
            ->get();

        $totalAmount = $rowData->sum('amount');

        return view('AppPlugin.CrmService.followUp.amount_list')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'totalAmount' => $totalAmount,
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
            $Query = self::TicketFilter(self::ViewOpenTicketUserPer($this->PrefixRole), null);
            $ticket = $Query->where('uuid', $ticketId)->firstOrFail();
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
            if ($ticket->follow_state != 3) {
                $followState = 3;
            } else {
                $viewActionBut = true;
            }
        } elseif ($RouteName == $this->PrefixRoute . '.UpdatePostponed') {
            $followState = 4;
        } elseif ($RouteName == $this->PrefixRoute . '.UpdateCancellation') {
            if ($ticket->follow_state != 3) {
                $followState = 5;
            } else {
                $viewActionBut = true;
            }
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
        try {
            $Query = self::TicketFilter(self::ViewOpenTicketUserPer($this->PrefixRole), null);
            $ticket = $Query->where('id', $ticketId)->firstOrFail();
        } catch (\Exception $e) {
            self::abortAdminError(403);
        }
        try {
            DB::transaction(function () use ($request, $ticket) {

                $follow_state = $request->input('follow_state');
                $saveThisData = true;
                self::UpdateTicketTable($ticket, $follow_state, $request, $saveThisData);
                self::AddTicketsDes($ticket->id, $follow_state, $request, $saveThisData);
                self::AddPayCash($ticket, $follow_state, $request, $saveThisData);
                if (in_array($follow_state, [2, 5, 6])) {
                    self::UpdateCustomersType($ticket, $saveThisData);
                }

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        return redirect()->route($this->PrefixRoute . '.New');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateTicketTable($ticket, $follow_state, $request, $saveThisData) {
        if (in_array($follow_state, [2, 5, 6])) {
            $ticket->state = 2;
            $ticket->follow_date = null;
            $ticket->close_date = getCurrentTime();
            $ticket->follow_state = $follow_state;
        } else {
            $ticket->follow_date = SaveDateFormat($request, 'follow_date') ?? null;
            if ($ticket->follow_state != 3) {
                $ticket->follow_state = $follow_state;
            }
        }
        if ($saveThisData) {
            $ticket->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AddTicketsDes($ticketId, $follow_state, $request, $saveThisData) {
        $ticketDes = new CrmTicketsDes();
        $ticketDes->created_at = getCurrentTime();
        if (in_array($follow_state, [2, 5, 6])) {
            $ticketDes->follow_date = null;
        } else {
            $ticketDes->follow_date = SaveDateFormat($request, 'follow_date') ?? null;
        }
        $ticketDes->ticket_id = $ticketId;
        $ticketDes->user_id = Auth::user()->id;
        $ticketDes->follow_state = $follow_state;
        $ticketDes->des = $request->input('des') ?? null;

        if ($saveThisData) {
            $ticketDes->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AddPayCash($ticket, $follow_state, $request, $saveThisData) {
        $addCash = new CrmTicketsCash();
        $addCash->ticket_id = $ticket->id;
        $addCash->customer_id = $ticket->customer_id;
        $addCash->follow_state = $follow_state;
        $addCash->created_at = saveOnlyDate();
        $addCash->created_at_time = getCurrentTime();
        $addCash->user_id = Auth::user()->id;

        if ($follow_state == 2) {
            $addCash->amount_type = 1;
            $addCash->pay_type = 1;

            if (intval($request->input('amount')) > 0) {
                if ($request->ticket_follow_state == 3) {
                    $addCash->amount = $request->input('amount') - $request->cash_amount;
                } else {
                    $addCash->amount = $request->input('amount');
                }
            }
            if ($saveThisData) {
                $addCash->save();
            }
        } elseif ($follow_state == 3) {
            if (intval($request->input('amount')) > 0) {
                $addCash->amount_type = 2;
                $addCash->pay_type = 1;
                $addCash->amount = $request->input('amount');
                if ($saveThisData) {
                    $addCash->save();
                }

            }

        } elseif ($follow_state == 6) {
            if (intval($request->input('amount')) > 0) {
                $addCash->amount_type = 3;
                $addCash->pay_type = 1;
                $addCash->amount = $request->input('amount');
                if ($saveThisData) {
                    $addCash->save();
                }
            }

            if ($request->ticket_follow_state == 3) {
                $updateOldCash = $ticket->paymentCash->where('ticket_id',$ticket->id)->where('follow_state', 3)->first();

                if ($updateOldCash) {
                    $updateOldCash->amount_type = 4;
                    $updateOldCash->confirm_date = null;
                    $updateOldCash->confirm_date = null;
                    $updateOldCash->confirm_date_time = null;
                    $updateOldCash->confirm_user_id = null;
                    $updateOldCash->amount_paid = null;
                    $updateOldCash->save();
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateCustomersType($ticket, $saveThisData) {
        $customer = CrmCustomers::query()->where('id', $ticket->customer_id)->first();
        $countDone = CrmTickets::query()
            ->where('customer_id', $customer->id)
            ->where('state', 2)
            ->where('follow_state', '2')->count();

        if ($countDone >= 1) {
            $customer->type_id = 1;
        } else {
            $customer->type_id = 2;
        }
        if ($saveThisData) {
            $customer->timestamps = false;
            $customer->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();

        $this->formName = "CrmUserFollowUp";
        View::share('formName', $this->formName);

        $session = self::getSessionData($request);
        $rowData = self::TicketFilter(self::FilterUserPer_OpenTicket($this->PrefixRole), $session);
        $getData = $rowData->get();

        $deviceId = $getData->groupBy('device_id')->toarray();
        $userId = $getData->groupBy('user_id')->toarray();
        $brandId = $getData->groupBy('brand_id')->toarray();
        $area_id = $getData->groupBy('area_id')->toarray();
        $follow_state = $getData->groupBy('follow_state')->toarray();

        $AllData = $rowData->count();
        $chartData['Device'] = self::ChartDataFromDataConfig($AllData, 'DeviceType', $deviceId);
        $chartData['BrandName'] = self::ChartDataFromDataConfig($AllData, 'BrandName', $brandId);
        $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, $area_id);
        $chartData['Users'] = self::ChartDataFromUsers($AllData, $userId);
        $chartData['FollowState'] = self::ChartDataFromDefCategory($AllData, 'CrmServiceTicketState', $follow_state);

        $card = [];
        $card['all_count'] = $AllData;
        $card['today_count'] = self::CountData(self::TicketFilter(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Today');
        $card['back_count'] = self::CountData(self::TicketFilter(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Back');
        $card['next_count'] = self::CountData(self::TicketFilter(self::FilterUserPer_OpenTicket($this->PrefixRole), $session), 'Next');

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
        $subMenu->sel_routs = "TechFollowUp.AmountList";
        $subMenu->url = "admin.TechFollowUp.AmountList";
        $subMenu->name = "admin/crm_service_menu.follow_list_amount";
        $subMenu->roleView = "crm_service_follow_view";
        $subMenu->icon = "fas fa-hand-holding-usd";
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
