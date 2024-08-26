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
    static function DefLeadsFilterQuery($query, $session, $order = null) {

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
    static function OpenTicketFilter($RouteVal, $PrefixRole) {
        $data = self::FilterUserPer_OpenTicket($PrefixRole);
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
    static function FilterUserPer_OpenTicket($PrefixRole) {
        if (Auth::user()->hasPermissionTo($PrefixRole . '_admin')) {
            $data = CrmTickets::defOpen();
        } else {
            if (Auth::user()->hasPermissionTo($PrefixRole . '_team_leader')) {
                $thisUserId = [Auth::user()->id];
                if (is_array(Auth::user()->crm_team)) {
                    $thisUserId = array_merge($thisUserId, Auth::user()->crm_team);
                }
                $data = CrmTickets::defOpen()->WhereIn('user_id', $thisUserId);
            } else {
                $data = CrmTickets::defOpen()->where('user_id', Auth::user()->id);
            }
        }
        return $data;
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
    static function ClosedTicketFilter($RouteVal) {
        $data = CrmTickets::defClosed();
        if ($RouteVal == "Finished") {
            $data->where('follow_state', 2);
        } elseif ($RouteVal == 'Cancellation') {
            $data->where('follow_state', 5);
        } elseif ($RouteVal == 'Reject') {
            $data->where('follow_state', 6);
        }
        return $data;
    }

}
