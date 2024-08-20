<?php

namespace App\AppPlugin\Crm\Customers\Seeder;


use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CrmCustomersSeeder extends Seeder {

    public function run(): void {

        $folder = config('adminConfig.app_folder');

        if (File::isFile(public_path('db/' . $folder . '/crm_customers.sql'))) {
            if ($folder) {
                CrmCustomers::unguard();
                $tablePath = public_path('db/' . $folder . '/crm_customers.sql');
                DB::unprepared(file_get_contents($tablePath));

                CrmCustomersAddress::unguard();
                $tablePath = public_path('db/' . $folder . '/crm_customers_address.sql');
                DB::unprepared(file_get_contents($tablePath));
            }
        }
    }

}
