<?php

namespace App\AppPlugin\Crm\Leads;

use App\AppCore\Menu\AdminMenu;


use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use App\AppPlugin\Crm\Leads\Request\CreateTicketRequest;
use App\AppPlugin\Crm\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CrmLeadsController extends AdminMainController {

    use CrmLeadsConfigTraits;

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
        $Per_edit = ['editTicket'];
        $Per_distribution = ['DistributionIndex'];
        $this->middleware('permission:' . $this->PrefixRole . '_distribution', ['only' => $Per_distribution]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $Per_edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => $Per_edit]);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => array_merge($Per_Add, $Per_edit,$Per_distribution)]);

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
        ]);
    }

    public function ViewInfo($id) {

        $pageData = $this->pageData;
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;
        $ticketInfo = CrmTickets::query()->defNew()->where('id', $id)->firstOrFail();

//        dd($ticketInfo->customer->address->first()->area_id);
        return view('AppPlugin.CrmLeads.view_info_ticket')->with([
            'pageData' => $pageData,

            'row' => $ticketInfo,

        ]);
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateTicket(CreateTicketRequest $request, $id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $saveData = CrmTickets::query()->defNew()->where('id', $id)->firstOrFail();;
        try {
            DB::transaction(function () use ($request, $saveData) {
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
        $Data = self::LeadsDataFilterQ(self::indexQuery(), $session);
        $rowData = $Data->paginate(30);
//        dd($rowData);
//        dd($Data->first());

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
    static function LeadsDataFilterQ($query, $session, $order = null) {

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
            $keyword = $session['country_id'];
            $query->whereHas('customer.address', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('country_id', $keyword);
                });
            });
        }

        if (isset($session['city_id']) and $session['city_id'] != null) {
            $keyword = $session['city_id'];
            $query->whereHas('customer.address', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('city_id', $keyword);
                });
            });
        }

        if (isset($session['area_id']) and $session['area_id'] != null) {
            $keyword = $session['area_id'];
            $query->whereHas('customer.address', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('area_id', $keyword);
                });
            });
        }

        return $query;
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

//        $subMenu = new AdminMenu();
//        $subMenu->parent_id = $mainMenu->id;
//        $subMenu->sel_routs = "CrmCustomer.Report.index|CrmCustomer.Report.filter";
//        $subMenu->url = "admin.CrmCustomer.Report.index";
//        $subMenu->name = "admin/crm/customers.app_menu_report";
//        $subMenu->roleView = "crm_customer_view";
//        $subMenu->icon = "fas fa-chart-pie";
//        $subMenu->save();

    }

}
