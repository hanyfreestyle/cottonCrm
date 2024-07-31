<?php

namespace App\AppPlugin\Crm\Customers\Traits;

trait CrmCustomersConfigTraits {

    static function defConfig() {

        $Config = [

            'defCountry' => config('app.defCountry'),
            'defCountryId' => config('app.defCountryId'),
            'addCountry' => true,
            'OneCountry' => true,
            'addressReq' => true,
            'googleAddress' => false,
            'postcode' => false,

            'phoneAreaCode' => false,
            'fullAddress' => true,
            'evaluation' => true,
            'gender' => true,

            'list_flag' => false,
            'list_evaluation' => true,

        ];

        $appConfig = loadConfigFromJson('CrmCustomers');
        $Config = array_merge($Config, $appConfig);

        return $Config;
    }


}
