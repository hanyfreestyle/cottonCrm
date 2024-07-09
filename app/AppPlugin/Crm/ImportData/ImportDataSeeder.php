<?php
namespace App\AppPlugin\Crm\ImportData;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDataSeeder extends Seeder {

    public function run(): void {
        ImportDataModel::unguard();
        $tablePath = public_path('db/config_data_import.sql');
        DB::unprepared(file_get_contents($tablePath));
    }

}
