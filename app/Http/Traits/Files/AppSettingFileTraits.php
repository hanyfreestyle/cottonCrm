<?php

namespace App\Http\Traits\Files;

use App\AppCore\DefPhoto\DefPhoto;
use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use Illuminate\Support\Facades\File;

trait AppSettingFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        $configPer = [
            ['cat_id' => 'config', 'name' => 'config_view', 'name_ar' => 'عرض الاعدادات', 'name_en' => 'Setting View'],
            ['cat_id' => 'config', 'name' => 'config_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'config', 'name' => 'config_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'config', 'name' => 'config_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'config', 'name' => 'config_app', 'name_ar' => 'الإعدادات العامة', 'name_en' => 'General Settings'],
            ['cat_id' => 'config', 'name' => 'config_defPhoto_view', 'name_ar' => 'الصور الافتراضية', 'name_en' => 'View'],
            ['cat_id' => 'config', 'name' => 'config_upFilter_view', 'name_ar' => 'فلاتر الصور', 'name_en' => 'View'],
            ['cat_id' => 'config', 'name' => 'adminlang_view', 'name_ar' => 'ملفات لغة التحكم', 'name_en' => 'Admin Lang File'],
        ];

        if (File::isFile(base_path('routes/AppPlugin/config/WebLangFile.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'weblang_view', 'name_ar' => 'ملفات لغة الموقع', 'name_en' => 'Web Lang File']];
            $configPer = array_merge($configPer, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_newsletter', 'name_ar' => 'القائمة البريدية', 'name_en' => 'News Letter']];
            $configPer = array_merge($configPer, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'sitemap_view', 'name_ar' => 'SiteMap', 'name_en' => 'SiteMap']];
            $configPer = array_merge($configPer, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_meta_view', 'name_ar' => 'ميتا تاج', 'name_en' => 'Meta']];
            $configPer = array_merge($configPer, $newPer);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_web_privacy', 'name_ar' => 'سياسية الاستخدام', 'name_en' => 'Web Privacy']];
            $configPer = array_merge($configPer, $newPer);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $newPer = [['cat_id' => 'config', 'name' => 'config_branch', 'name_ar' => 'الفروع', 'name_en' => 'Branch']];
            $configPer = array_merge($configPer, $newPer);
        }

        $data = array_merge($data, $configPer);


        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            $newPer = [
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'app_setting', 'name' => 'AppSetting_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ];
            $data = array_merge($data, $newPer);
        }


//        if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
//            $newPer = [
//                ['cat_id' => 'leads', 'name' => 'leads_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'leads', 'name' => 'leads_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'leads', 'name' => 'leads_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'leads', 'name' => 'leads_export', 'name_ar' => 'تصدير', 'name_en' => 'Export'],
//                ['cat_id' => 'leads', 'name' => 'leads_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//            ];
//            $data = array_merge($data, $newPer);
//        }
//
//
//        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            $newPer = getDefPermission('crm_customer', true);
//            $data = array_merge($data, $newPer);
//        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {

        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            AppSettingController::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            $addLang = ['Apps' => ['id' => 'Apps', 'group' => 'admin', 'file_name' => 'configApp', 'name' => 'AppSetting', 'name_ar' => 'اعدادات التطبيق'],];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $addLang = ['Privacy' => ['id' => 'Privacy', 'group' => 'admin', 'file_name' => 'configPrivacy', 'name' => 'Privacy', 'name_ar' => 'سياسية الاستخدام']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $addLang = ['Branch' => ['id' => 'Branch', 'group' => 'admin', 'file_name' => 'configBranch', 'name' => 'Branch', 'name_ar' => 'الفروع']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
            $addLang = ['newsletter' => ['id' => 'newsletter', 'group' => 'admin', 'file_name' => 'leadsNewsLetter', 'name' => 'Newsletter', 'name_ar' => 'القائمة البريدية']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $addLang = ['Meta' => ['id' => 'Meta', 'group' => 'admin', 'file_name' => 'configMeta', 'name' => 'Meta Tage', 'name_ar' => 'ميتا تاج']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $addLang = ['SiteMap' => ['id' => 'SiteMap', 'group' => 'admin', 'file_name' => 'siteMap', 'name' => 'SiteMap', 'name_ar' => 'SiteMap']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
            $addLang = ['leadForm' => ['id' => 'leadForm', 'group' => 'admin', 'file_name' => 'leadsContactUs', 'name' => 'Lead Form', 'name_ar' => 'الاتصاللات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        SeedDbFile(Setting::class, 'config_setting.sql');
        SeedDbFile(SettingTranslation::class, 'config_setting_translations.sql');
        SeedDbFile(DefPhoto::class, 'config_def_photos.sql');
        SeedDbFile(UploadFilter::class, 'config_upload_filter.sql');
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


        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            SeedDbFile(AppSetting::class, 'config_app_setting.sql');
            SeedDbFile(AppSettingTranslation::class, 'config_app_setting_translations.sql');
            SeedDbFile(AppMenu::class, 'config_app_menu.sql');
            SeedDbFile(AppMenuTranslation::class, 'config_app_menu_translations.sql');
        }


    }

}
