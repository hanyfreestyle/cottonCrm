<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Seeder;


use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsDes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CrmTicketsSeeder extends Seeder {

    public function run(): void {


        SeedDbFile(CrmTickets::class, 'crm_ticket.sql');
        SeedDbFile(CrmTicketsDes::class, 'crm_ticket_des.sql');

    }

}
