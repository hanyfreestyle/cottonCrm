<?php

namespace App\AppPlugin\Crm\Customers\Traits;

trait CrmCustomersConfigTraits {

    static function defConfig() {

        $Config = [

            'defCountry' => config('app.defCountry'),
            'defCountryId' => config('app.defCountryId'),
            'addCountry' => true,
            'OneCountry' => false,
            'addressReq' => true,
            'googleAddress' => true,
            'postcode' => false,

            'phoneAreaCode' => true,
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
