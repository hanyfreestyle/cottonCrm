<?php

namespace App\AppPlugin\Crm\Customers\Traits;


trait CrmCustomersConfigTraits {

    static function defConfig() {

        $Config = [
            'defCountry' => config('app.defCountry'),
            'defCountryId' => config('app.defCountryCode'),
            'addCountry' => true,
            'OneCountry' => true,
            'phoneAreaCode' => false,
            'fullAddress' => true,
            'evaluation' => true,
            'gender' => true,
        ];

        return $Config;
    }


}
