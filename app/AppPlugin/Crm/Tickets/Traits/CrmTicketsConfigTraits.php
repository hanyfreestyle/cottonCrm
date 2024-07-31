<?php

namespace App\AppPlugin\Crm\Tickets\Traits;

trait CrmTicketsConfigTraits {

    static function defConfig() {

        $Config = [
            'list_evaluation' => true,

        ];
        $appConfig = loadConfigFromJson('CrmTickets');
        $Config = array_merge($Config, $appConfig);

        return $Config;
    }


}
