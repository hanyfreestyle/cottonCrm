<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Seeder;


use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsDes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CrmTicketsSeeder extends Seeder {

    public function run(): void {

        $folder = config('adminConfig.app_folder');

        if (File::isFile(public_path('db/' . $folder . '/crm_ticket.sql'))) {
            if ($folder) {

                CrmTickets::unguard();
                $tablePath = public_path('db/' . $folder . '/crm_ticket.sql');
                DB::unprepared(file_get_contents($tablePath));

                CrmTicketsDes::unguard();
                $tablePath = public_path('db/' . $folder . '/crm_ticket_des.sql');
                DB::unprepared(file_get_contents($tablePath));
            }
        }
    }

}
