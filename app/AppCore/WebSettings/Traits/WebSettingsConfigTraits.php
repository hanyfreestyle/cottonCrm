<?php

namespace App\AppCore\WebSettings\Traits;


use App\AppCore\Menu\AdminMenu;
use Illuminate\Support\Facades\File;

trait WebSettingsConfigTraits {

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

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {


        return $LangMenu;
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
        $mainMenu->postion = 80;
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
            $subMenu->sel_routs = "WebPrivacy.index|WebPrivacy.create|WebPrivacy.edit|WebPrivacy.config";
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

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadWebLangMenu() {
        if (File::isFile(base_path('routes/AppPlugin/config/WebLangFile.php'))) {
            $mainMenu = new AdminMenu();
            $mainMenu->type = "One";
            $mainMenu->sel_routs = "admin.weblang";
            $mainMenu->url = "admin.weblang.index";
            $mainMenu->name = "admin.app_menu_lang_web";
            $mainMenu->icon = "fas fa-language";
            $mainMenu->roleView = "weblang_view";
            $mainMenu->is_active =  true;
            $mainMenu->postion =  101;
            $mainMenu->save();
        }
    }
}
