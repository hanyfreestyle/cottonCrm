<?php

namespace App\AppPlugin\Crm\CrmService\Leads\Traits;

use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;

trait CrmLeadsConfigTraits {
    use CrmCustomersConfigTraits ;

    static function defConfig() {

        $CustomersConfig = self::defConfigCustomers();


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
