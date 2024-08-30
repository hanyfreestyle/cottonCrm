<?php

namespace App\AppPlugin\Crm\CrmService\Leads;

use App\AppPlugin\Crm\CrmService\Leads\Request\CreateTicketRequest;
use App\AppPlugin\Crm\CrmService\Leads\Request\DistributiontRequest;
use App\AppPlugin\Crm\CrmService\Tickets\Traits\CrmDataTableTraits;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\Http\Controllers\AdminMainController;
use App\AppPlugin\Crm\CrmCore\CrmMainTraits;
use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\AppCore\Menu\AdminMenu;
use Illuminate\Support\Str;

class CrmLeadsController extends AdminMainController {

    use CrmLeadsConfigTraits;
    use CrmMainTraits;
    use ReportFunTraits;
    use CrmDataTableTraits ;

    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmLeads";
        $this->PrefixRole = 'crm_service_leads';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/leads.";
        View::share('defLang', $this->defLang);

        $this->config = self::defConfig();
        View::share('config', $this->config);

        $this->PageTitle = __('admin/crm_service_menu.leads');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddButToCard' => false,
            'formName' => "CrmDistributionFilter",
        ];

        self::constructData($sendArr);
        $per = [
            'view' => ['DistributionIndex'],
            'create' => ['addTicket', 'SearchFormCustomer', 'SearchFormCustomerFilter'],
            'edit' => ['editTicket'],
            'delete' => ['destroy'],
            'distribution' => ['DistributionIndex'],
            'report' => ['report'],
        ];
        self::loadPagePermission($per);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function addTicket($customerID) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __('admin/crm.but_add_new');
        $customer = CrmCustomers::where('id', $customerID)->with('address')->firstOrFail();
        $ticketInfo = new CrmTickets();

        return view('AppPlugin.CrmService.leads.form_add_ticket')->with([
            'pageData' => $pageData,
            'customer' => $customer,
            'ticketInfo' => $ticketInfo,
            'form_route' => '.createTicket',
            'followDate' => null,
            'UpdateId' => $customerID
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CreateTicket(CreateTicketRequest $request, $customerID) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $customer = CrmCustomers::where('id', $customerID)->firstOrFail();
        try {
            DB::transaction(function () use ($request, $customer) {
                $saveData = new CrmTickets();
                $saveData->uuid = Str::uuid()->toString();
                $saveData->customer_id = $customer->id;
                $saveData->state = 1;
                $saveData->follow_state = 1;
                $saveData->open_type = $request->input('open_type');
                $saveData->follow_date = SaveDateFormat($request, 'follow_date');
                $saveData->user_id = $request->input('user_id') ?? null;
                $saveData->sours_id = $request->input('sours_id');
                $saveData->ads_id = $request->input('ads_id');
                $saveData->device_id = $request->input('device_id');
                $saveData->brand_id = $request->input('brand_id');
                $saveData->notes_err = $request->input('notes_err');
                $saveData->notes = $request->input('notes');
                $saveData->save();
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return redirect()->route('admin.CrmLeads.SearchFormCustomer');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DistributionIndex(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __('admin/crm_service_menu.leads_distribution');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $Data = self::TicketFilter(self::indexQuery(), $session);
        $rowData = $Data->paginate(30);
        return view('AppPlugin.CrmService.leads.distribution')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {
        $data = CrmTickets::query()
            ->where('state', 1)
            ->where('follow_state', 1)
            ->where('user_id', null)
            ->with('customer');
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AddToUser(DistributiontRequest $request) {
        if ($request->input('ids') and is_array($request->input('ids'))) {
            $ticketIds = $request->input('ids');
            $Tickets = CrmTickets::query()->defNew()->wherein('id', $ticketIds)->get();
            foreach ($Tickets as $ticket) {
                $ticket->user_id = $request->input('user_id');
                $ticket->save();
            }
        }
        return back()->with('confirmDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editTicket($id) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __('admin/crm.but_edit_new');
        $pageData['SubView'] = false;
        $ticketInfo = CrmTickets::query()->defNew()->where('id', $id)->firstOrFail();
        $customerID = $ticketInfo->customer_id;
        $customer = CrmCustomers::where('id', $customerID)->with('address')->firstOrFail();

        return view('AppPlugin.CrmService.leads.form_add_ticket')->with([
            'pageData' => $pageData,
            'customer' => $customer,
            'ticketInfo' => $ticketInfo,
            'form_route' => '.updateTicket',
            'followDate' => PrintDate($ticketInfo->follow_date),
            'UpdateId' => $ticketInfo->id
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateTicket(CreateTicketRequest $request, $id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $saveData = CrmTickets::query()->defNew()->where('id', $id)->firstOrFail();
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->follow_date = SaveDateFormat($request, 'follow_date');
                $saveData->user_id = $request->input('user_id');
                $saveData->sours_id = $request->input('sours_id');
                $saveData->ads_id = $request->input('ads_id');
                $saveData->device_id = $request->input('device_id');
                $saveData->brand_id = $request->input('brand_id');
                $saveData->notes_err = $request->input('notes_err');
                $saveData->notes = $request->input('notes');
                $saveData->save();
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return redirect()->route('admin.CrmLeads.distribution');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function destroy($id) {
        $deleteRow = CrmTickets::query()->where('id', $id)
            ->where('state', 1)
            ->where('follow_state', 1)->firstOrFail();
        $deleteRow->forceDelete();
        return back()->with('confirmDelete', "");
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
        $rowData = self::TicketFilter(self::indexQuery(), $session);
        $getData = $rowData->get();

        $deviceId = $getData->groupBy('device_id')->toarray();
        $brandId = $getData->groupBy('brand_id')->toarray();
        $soursId = $getData->groupBy('sours_id')->toarray();
        $adsId = $getData->groupBy('ads_id')->toarray();
        $city_id = $getData->groupBy('customer.address.0.city_id')->toarray();
        $area_id = $getData->groupBy('customer.address.0.area_id')->toarray();


        $AllData = $rowData->count();
        $chartData['Device'] = self::ChartDataFromDataConfig($AllData, 'DeviceType', $deviceId);
        $chartData['BrandName'] = self::ChartDataFromDataConfig($AllData, 'BrandName', $brandId);
        $chartData['LeadSours'] = self::ChartDataFromDataConfig($AllData, 'LeadSours', $soursId);
        $chartData['LeadCategory'] = self::ChartDataFromDataConfig($AllData, 'LeadCategory', $adsId);
        $chartData['City'] = self::ChartDataFromModel($AllData, City::class, $city_id);
        $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, $area_id);


        View::share('chartData', $chartData);
        View::share('session', $session);

        $chartQ = self::DataTableIndex(null);
        $weekChart = self::getChartWeek($chartQ,'crm_ticket.created_at');
        $monthChart = self::getChartMonth($chartQ,'crm_ticket.created_at');
        View::share('weekChart', $weekChart);
        View::share('monthChart', $monthChart);


        return view('AppPlugin.CrmService.leads.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'chartData' => $chartData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.CrmLeads";
        $mainMenu->name = "admin/crm_service_menu.leads";
        $mainMenu->icon = "fas fa-phone-volume";
        $mainMenu->roleView = "crm_service_leads_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.SearchFormCustomer|CrmLeads.SearchFormCustomerFilter|addTicket";
        $subMenu->url = "admin.CrmLeads.SearchFormCustomer";
        $subMenu->name = "admin/crm_service_menu.leads_add";
        $subMenu->roleView = "crm_service_leads_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();

//        $subMenu = new AdminMenu();
//        $subMenu->parent_id = $mainMenu->id;
//        $subMenu->sel_routs = "admin.CrmLeads.index";
//        $subMenu->url = "admin.CrmLeads.index";
//        $subMenu->name = "admin/crm_service_menu.leads_add_bulk";
//        $subMenu->roleView = "crm_leads_view";
//        $subMenu->icon = "fas fa-file-excel";
//        $subMenu->save();
//
        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.distribution|CrmLeads.filter";
        $subMenu->url = "admin.CrmLeads.distribution";
        $subMenu->name = "admin/crm_service_menu.leads_distribution";
        $subMenu->roleView = "crm_service_leads_distribution";
        $subMenu->icon = "fas fa-random";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.report|CrmLeads.filterReport";
        $subMenu->url = "admin.CrmLeads.report";
        $subMenu->name = "admin/crm_service_menu.report";
        $subMenu->roleView = "crm_service_leads_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }

}
