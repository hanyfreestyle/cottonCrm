<?php

namespace App\Http\Traits\Files;

use App\AppCore\DefPhoto\DefPhoto;
use App\AppCore\Menu\AdminMenu;
use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppPlugin\Config\Apps\AppSettingController;
use App\AppPlugin\Config\Apps\Models\AppMenu;
use App\AppPlugin\Config\Apps\Models\AppMenuTranslation;
use App\AppPlugin\Config\Apps\Models\AppSetting;
use App\AppPlugin\Config\Apps\Models\AppSettingTranslation;
use App\AppPlugin\Config\Branche\Branch;
use App\AppPlugin\Config\Branche\BranchTranslation;
use App\AppPlugin\Config\Meta\MetaTag;
use App\AppPlugin\Config\Meta\MetaTagTranslation;
use App\AppPlugin\Config\Privacy\WebPrivacy;
use App\AppPlugin\Config\Privacy\WebPrivacyTranslation;
use App\AppPlugin\Config\SiteMap\GoogleCode;
use App\AppPlugin\Leads\NewsLetter\NewsLetter;
use Illuminate\Support\Facades\DB;
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
            ['cat_id' => 'config', 'name' => 'config_export', 'name_ar' => 'تصدير البيانات', 'name_en' => 'Export Data'],
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

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.config";
        $mainMenu->name = "admin.app_menu_setting";
        $mainMenu->icon = "fas fa-cogs";
        $mainMenu->roleView = "config_view";
        $mainMenu->position = 80;
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "web.index";
        $subMenu->url = "admin.config.web.index";
        $subMenu->name = "admin/config/webConfig.app_menu";
        $subMenu->roleView = "config_app";
        $subMenu->icon = "fas fa-cog";
        $subMenu->save();

        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "Meta.index|Meta.create|Meta.edit|Meta.config";
            $subMenu->url = "admin.config.Meta.index";
            $subMenu->name = "admin/configMeta.app_menu";
            $subMenu->roleView = "config_meta_view";
            $subMenu->icon = "fab fa-html5";
            $subMenu->save();
        }

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "defPhoto.index|defPhoto.create|defPhoto.edit|defPhoto.config|defPhoto.sortDefPhotoList";
        $subMenu->url = "admin.config.defPhoto.index";
        $subMenu->name = "admin/config/upFilter.app_menu_def_photo";
        $subMenu->roleView = "config_defPhoto_view";
        $subMenu->icon = "fas fa-image";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "upFilter.index|upFilter.create|upFilter.edit|upFilter.config|upFilter.size.create|upFilter.size.edit";
        $subMenu->url = "admin.config.upFilter.index";
        $subMenu->name = "admin/config/upFilter.app_menu";
        $subMenu->roleView = "config_upFilter_view";
        $subMenu->icon = "fas fa-filter";
        $subMenu->save();

        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "WebPrivacy.index|WebPrivacy.create|WebPrivacy.edit|WebPrivacy.config|WebPrivacy.Sort";
            $subMenu->url = "admin.config.WebPrivacy.index";
            $subMenu->name = "admin/configPrivacy.app_menu";
            $subMenu->roleView = "config_web_privacy";
            $subMenu->icon = "fas fa-file-alt";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "NewsLetter.index";
            $subMenu->url = "admin.config.NewsLetter.index";
            $subMenu->name = "admin/leadsNewsLetter.app_menu";
            $subMenu->roleView = "config_newsletter";
            $subMenu->icon = "fas fa-mail-bulk";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "SiteMap.index|SiteMap.Robots|SiteMap.GoogleCode";
            $subMenu->url = "admin.config.SiteMap.index";
            $subMenu->name = "Site Maps";
            $subMenu->roleView = "sitemap_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }


        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "Branch.index|Branch.create|Branch.edit|Branch.config";
            $subMenu->url = "admin.config.Branch.index";
            $subMenu->name = "admin/configBranch.app_menu";
            $subMenu->roleView = "config_branch";
            $subMenu->icon = "fas fa-map-signs";
            $subMenu->save();
        }


        if (File::isFile(base_path('routes/AppPlugin/config/WebLangFile.php'))) {
            $mainMenu = new AdminMenu();
            $mainMenu->type = "One";
            $mainMenu->sel_routs = "admin.weblang";
            $mainMenu->url = "admin.weblang.index";
            $mainMenu->name = "admin.app_menu_lang_web";
            $mainMenu->icon = "fas fa-language";
            $mainMenu->roleView = "weblang_view";
            $mainMenu->is_active = true;
            $mainMenu->position = 101;
            $mainMenu->save();
        }

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

        $folder = config('adminConfig.app_folder');
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


        if (File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
            SeedDbFile(NewsLetter::class, 'leads_news_letters.sql');
        }

    }

}
