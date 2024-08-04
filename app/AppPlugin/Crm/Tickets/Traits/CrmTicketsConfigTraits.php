<?php

namespace App\AppPlugin\Crm\Tickets\Traits;

use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use Illuminate\Support\Carbon;

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
