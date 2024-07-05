<?php

namespace App\AppPlugin\Crm\Customers\Traits;


trait CrmCustomersConfigTraits {

    static function defConfig() {
        $Config = [
            'addCountry' => true,
            'fullAddress' => true,
            'evaluation' => true,
        ];

        return $Config;
    }


}
