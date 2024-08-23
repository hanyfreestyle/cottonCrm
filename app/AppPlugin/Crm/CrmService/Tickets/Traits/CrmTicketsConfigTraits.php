<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Traits;

use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait CrmTicketsConfigTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function defConfig() {

        $CustomersConfig = CrmCustomersConfigTraits::defConfig();
        $Config = [
            'leads_sours_id' => true,
            'leads_ads_id' => true,
            'leads_device_id' => true,
            'leads_brand_id' => true,
        ];
        $Config = array_merge($Config, $CustomersConfig);


        $appConfig = loadConfigFromJson('CrmLeads');
        $Config = array_merge($Config, $appConfig);

        return $Config;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery_OpenTicket($RouteVal, $PrefixRole) {
        $data = self::FilterUserPer_OpenTicket($PrefixRole);
//         dd($data->first());
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
    static function TicketFilterQuery($query, $session, $order = null) {

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

}
