<?php

namespace App\AppPlugin\Crm\CrmCore;


use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

trait CrmMainTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SearchFormCustomer() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $this->defLang = "admin/crm_customer.";
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
    public function SearchFormCustomerFilter(CrmCustomersSearchRequest $request) {
        $pageData = $this->pageData;
        $this->defLang = "admin/crm_customer.";
        View::share('defLang', $this->defLang);
        $pageData['ViewType'] = "LeadsSearch";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $pageData['BoxH2'] = __($this->defLang . 'app_menu_search_results');
        $rowData = CrmCustomersController::CustomersSearchFilter($request);
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => true,
            'request' => $request,
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

}
