<?php

namespace App\AppCore\WebSettings\Seeder;

use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppPlugin\Config\Branche\SeederBranch;
use App\AppPlugin\Config\Meta\SeederMetaTag;
use App\AppPlugin\Config\Privacy\SeederWebPrivacy;
use App\AppPlugin\Config\SiteMap\GoogleCodeSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingsTableSeeder extends Seeder {
    public function run(): void {
        Setting::unguard();
        $tablePath = public_path('db/config_settings.sql');
        DB::unprepared(file_get_contents($tablePath));

        SettingTranslation::unguard();
        $tablePath = public_path('db/config_setting_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $this->call(SeederMetaTag::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $this->call(SeederWebPrivacy::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $this->call(GoogleCodeSeeder::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $this->call(SeederBranch::class);
        }


    }
}
