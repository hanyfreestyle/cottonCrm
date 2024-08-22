<?php

namespace App\AppPlugin\Crm\Leads;

use App\AppCore\Menu\AdminMenu;


use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use App\AppPlugin\Crm\Leads\Request\CreateTicketRequest;
use App\AppPlugin\Crm\Leads\Request\DistributiontRequest;
use App\AppPlugin\Crm\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Tickets\Traits\CrmTicketsConfigTraits;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CrmLeadsController extends AdminMainController {

    use CrmLeadsConfigTraits;
//    use CrmTicketsConfigTraits;
    use ReportFunTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmLeads";
        $this->PrefixRole = 'crm_leads';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/leads.";
        View::share('defLang', $this->defLang);

        $this->Config = self::defConfig();
        View::share('Config', $this->Config);

        $this->PageTitle = __($this->defLang . 'app_menu');
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
            'formName' => "CrmDistributionFilter",
        ];

        self::loadConstructData($sendArr);

        $Per_Add = ['AddNew', 'searchFilter', 'addTicket', 'CreateTicket'];
        $Per_Edit = ['editTicket'];
        $Per_report = ['Report'];
        $Per_Delete = ['destroy'];
        $Per_distribution = ['DistributionIndex'];

        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => $Per_Add]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $Per_Edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => $Per_Delete]);
        $this->middleware('permission:' . $this->PrefixRole . '_report', ['only' => $Per_report]);
        $this->middleware('permission:' . $this->PrefixRole . '_distribution', ['only' => $Per_distribution]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => array_merge($Per_Add, $Per_Edit, $Per_Delete, $Per_distribution,$Per_report)]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AddNew() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $rowData = CrmCustomers::query()->where('id', 0)->get();
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => false,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function searchFilter(CrmCustomersSearchRequest $request) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "LeadsSearch";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $pageData['BoxH2'] = __($this->defLang . 'app_menu_search_results');
        $rowData = CrmCustomersController::CustomersSearchFilter($request);
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => true,
            'request'=> $request,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function addTicket($customerID) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;
        $customer = CrmCustomers::where('id', $customerID)->with('address')->firstOrFail();
        $ticketInfo = new CrmTickets();

        return view('AppPlugin.CrmLeads.form_add_ticket')->with([
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
                $saveData->customer_id = $customer->id;
                $saveData->state = 1;
                $saveData->follow_state = 1;
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
        return redirect()->route('admin.CrmLeads.addNew');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editTicket($id) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;
        $ticketInfo = CrmTickets::query()->defNew()->where('id', $id)->firstOrFail();
        $customerID = $ticketInfo->customer_id;
        $customer = CrmCustomers::where('id', $customerID)->with('address')->firstOrFail();

        return view('AppPlugin.CrmLeads.form_add_ticket')->with([
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
    public function DistributionIndex(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __('admin/crm/leads.app_menu_distribution');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $Data = self::TicketFilterQuery(self::indexQuery(), $session);
        $rowData = $Data->paginate(30);

        return view('AppPlugin.CrmLeads.distribution')->with([
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
        $rowData = self::TicketFilterQuery(self::indexQuery(), $session);
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
//        $chartData['Gender'] = self::ChartDataFromDefCategory($AllData, 'gender', $GenderId);
        return view('AppPlugin.CrmLeads.report')->with([
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
        $mainMenu->name = "admin/crm/leads.app_menu";
        $mainMenu->icon = "fas fa-phone-volume";
        $mainMenu->roleView = "crm_leads_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.addNew|CrmLeads.searchFilter|CrmLeads.addTicket";
        $subMenu->url = "admin.CrmLeads.addNew";
        $subMenu->name = "admin/crm/leads.app_menu_add";
        $subMenu->roleView = "crm_leads_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "admin.CrmLeads.index";
        $subMenu->url = "admin.CrmLeads.index";
        $subMenu->name = "admin/crm/leads.app_menu_add_bulk";
        $subMenu->roleView = "crm_leads_view";
        $subMenu->icon = "fas fa-file-excel";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.distribution|CrmLeads.filter";
        $subMenu->url = "admin.CrmLeads.distribution";
        $subMenu->name = "admin/crm/leads.app_menu_distribution";
        $subMenu->roleView = "crm_leads_distribution";
        $subMenu->icon = "fas fa-random";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmLeads.report|CrmLeads.filterReport";
        $subMenu->url = "admin.CrmLeads.report";
        $subMenu->name = "admin/crm/leads.app_menu_report";
        $subMenu->roleView = "crm_leads_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ViewInfo($id) {

        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;
        $ticketInfo = CrmTickets::query()->defNew()->where('id', $id)->firstOrFail();

        return view('AppPlugin.CrmLeads.view_info_ticket')->with([
            'pageData' => $pageData,
            'row' => $ticketInfo,
        ]);
    }

}
