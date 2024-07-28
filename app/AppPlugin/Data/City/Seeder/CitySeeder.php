<?php
namespace App\AppPlugin\Data\City\Seeder;

use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\City\Models\CityTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder {

    public function run(): void {
        $folder = config('adminConfig.app_folder');

        if ($folder) {
            City::unguard();
            $tablePath = public_path('db/' . $folder . '/data_city.sql');
            DB::unprepared(file_get_contents($tablePath));

            CityTranslation::unguard();
            $tablePath = public_path('db/' . $folder . '/data_city_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

    }

}
