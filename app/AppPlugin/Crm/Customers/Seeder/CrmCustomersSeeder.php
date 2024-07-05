<?php

namespace App\AppPlugin\Crm\Customers\Seeder;


use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CrmCustomersSeeder extends Seeder {

    public function run(): void {

        CrmCustomers::unguard();
        $tablePath = public_path('db/crm_customers.sql');
        DB::unprepared(file_get_contents($tablePath));

        CrmCustomersAddress::unguard();
        $tablePath = public_path('db/crm_customers_address.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
