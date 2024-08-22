<?php

namespace App\AppPlugin\Crm\Leads\Traits;


use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;

trait CrmLeadsConfigTraits {

    static function defConfig() {

        $CustomersConfig = CrmCustomersConfigTraits::defConfig();
        $config = [
            'leads_sours_id' => true,
            'leads_ads_id' => true,
            'leads_device_id' => false,
            'leads_brand_id' => false,
        ];
        $config = array_merge($config, $CustomersConfig);

        $appConfig = loadConfigFromJson('crm_leads', $config);
        $config = array_merge($config, $appConfig);

        return $config;
    }
}
