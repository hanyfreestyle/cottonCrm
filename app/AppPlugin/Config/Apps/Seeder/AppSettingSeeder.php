<?php

namespace App\AppPlugin\Config\Apps\Seeder;

use App\AppPlugin\Config\Apps\Models\AppMenu;
use App\AppPlugin\Config\Apps\Models\AppMenuTranslation;
use App\AppPlugin\Config\Apps\Models\AppSetting;
use App\AppPlugin\Config\Apps\Models\AppSettingTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder {

    public function run(): void {

        AppSetting::unguard();
        $tablePath = public_path('db/config_app_setting.sql');
        DB::unprepared(file_get_contents($tablePath));

        AppSettingTranslation::unguard();
        $tablePath = public_path('db/config_app_setting_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

        AppMenu::unguard();
        $tablePath = public_path('db/config_app_menu.sql');
        DB::unprepared(file_get_contents($tablePath));

        AppMenuTranslation::unguard();
        $tablePath = public_path('db/config_app_menu_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
