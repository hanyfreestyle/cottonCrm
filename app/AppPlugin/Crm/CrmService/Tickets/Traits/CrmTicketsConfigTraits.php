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



}
