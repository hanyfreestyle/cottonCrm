<?php
namespace App\AppPlugin\Data\City\Seeder;

use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\City\Models\CityTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder {

    public function run(): void {
        $folder = config('adminConfig.app_folder');
        if (File::isFile(public_path('db/' . $folder . '/data_city.sql'))) {
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

}
