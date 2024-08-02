<?php

namespace App\AppPlugin\Crm\Leads\Traits;

use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;

trait CrmLeadsConfigTraits {

    static function defConfig() {

        $CustomersConfig = CrmCustomersConfigTraits::defConfig();
        $Config = [
            'leads_sours_id' => true,
//            'leads_ads_id' => true,
//            'leads_device_id' => true,
//            'leads_brand_id' => true,
        ];
        $Config = array_merge($Config, $CustomersConfig);


        $appConfig = loadConfigFromJson('CrmLeads');
        $Config = array_merge($Config, $appConfig);

        return $Config;
    }


}
