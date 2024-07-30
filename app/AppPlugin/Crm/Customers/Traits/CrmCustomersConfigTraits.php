<?php

namespace App\AppPlugin\Crm\Customers\Traits;


trait CrmCustomersConfigTraits {

    static function defConfig() {

        $Config = [
            'defCountry' => config('app.defCountry'),
            'defCountryId' => config('app.defCountryCode'),
            'addCountry' => true,
            'OneCountry' => false,
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

        return $Config;
    }


}
