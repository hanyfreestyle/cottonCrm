<?php

namespace App\AppPlugin\Data\ConfigData\Seeder;


use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigDataSeeder extends Seeder {

    public function run(): void {

        $folder = config('adminConfig.app_folder');

        if ($folder) {

            ConfigData::unguard();
            $tablePath = public_path('db/' . $folder . '/config_data.sql');
            DB::unprepared(file_get_contents($tablePath));

            ConfigDataTranslation::unguard();
            $tablePath = public_path('db/' . $folder . '/config_data_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

//        ConfigData::query()->wherein('cat_id',['BookRelease','BookLang'])->delete();

    }

}
