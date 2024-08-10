<?php

namespace App\AppCore\WebSettings\Seeder;

use App\AppCore\DefPhoto\DefPhoto;
use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppPlugin\Config\Branche\Branch;
use App\AppPlugin\Config\Branche\BranchTranslation;
use App\AppPlugin\Config\Meta\MetaTag;
use App\AppPlugin\Config\Meta\MetaTagTranslation;
use App\AppPlugin\Config\Privacy\WebPrivacy;
use App\AppPlugin\Config\Privacy\WebPrivacyTranslation;
use App\AppPlugin\Config\SiteMap\GoogleCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ApplicationSettingsSeeder extends Seeder {
    public function run(): void {

        SeedDbFile(Setting::class, 'config_settings.sql');
        SeedDbFile(SettingTranslation::class, 'config_setting_translations.sql');
        SeedDbFile(DefPhoto::class, 'config_def_photos.sql');
        SeedDbFile(UploadFilter::class, 'config_upload_filters.sql');
        SeedDbFile(UploadFilterSize::class, 'config_upload_filter_sizes.sql');

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            SeedDbFile(MetaTag::class, 'config_meta_tag.sql');
            SeedDbFile(MetaTagTranslation::class, 'config_meta_tag_translations.sql');
        }

        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            SeedDbFile(WebPrivacy::class, 'config_web_privacy.sql', false);
            SeedDbFile(WebPrivacyTranslation::class, 'config_web_privacy_translations.sql', false);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            SeedDbFile(GoogleCode::class, 'config_site_robots.sql');
        }

        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            SeedDbFile(Branch::class, 'config_branch.sql');
            SeedDbFile(BranchTranslation::class, 'config_branch_translations.sql');
        }

    }
}
