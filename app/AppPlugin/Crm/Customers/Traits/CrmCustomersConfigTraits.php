<?php

namespace App\AppPlugin\Crm\Customers\Traits;


trait CrmCustomersConfigTraits {

    static function defConfig() {

        $Config = [
            'defCountry' => config('app.defCountry'),
            'defCountryId' => config('app.defCountryCode'),
            'addCountry' => true,
            'OneCountry' => true,
            'addressReq' => true,
            'googleAddress' => true,
            'postcode' => true,

            'phoneAreaCode' => false,
            'fullAddress' => true,
            'evaluation' => true,
            'gender' => true,

            'list_flag' => false,

        ];

        return $Config;
    }


}
