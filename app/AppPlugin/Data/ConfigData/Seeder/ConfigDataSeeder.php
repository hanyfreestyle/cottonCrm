<?php

namespace App\AppPlugin\Data\ConfigData\Seeder;


use App\AppPlugin\Data\Area\Seeder\AreaSeeder;
use App\AppPlugin\Data\City\Seeder\CitySeeder;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\AppPlugin\Data\Country\SeederCountry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ConfigDataSeeder extends Seeder {

    public function run(): void {

        $folder = config('adminConfig.app_folder');


        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {
            if (File::isFile(public_path('db/' . $folder . '/config_data.sql'))) {

                ConfigData::unguard();
                $tablePath = public_path('db/' . $folder . '/config_data.sql');
                DB::unprepared(file_get_contents($tablePath));

                ConfigDataTranslation::unguard();
                $tablePath = public_path('db/' . $folder . '/config_data_translations.sql');
                DB::unprepared(file_get_contents($tablePath));

            }
        }


        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $this->call(SeederCountry::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $this->call(CitySeeder::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $this->call(AreaSeeder::class);
        }


    }

}
