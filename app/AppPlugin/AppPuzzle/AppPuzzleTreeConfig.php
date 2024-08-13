<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeConfig {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'WebLangFile' => self::treeWebLangFile(),
            'ConfigMeta' => self::treeConfigMeta(),
            'ConfigPrivacy' => self::treeConfigPrivacy(),
            'ConfigApps' => self::treeConfigApps(),
            'ConfigBranch' => self::treeConfigBranch(),
            'SiteMaps' => self::treeSiteMaps(),
            'LeadsNewsLetter' => self::treeLeadsNewsLetter(),
            'LeadsContactUs' => self::treeLeadsContactUs(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeWebLangFile() {
        return [
            'view' => true,
            'id' => "WebLangFile",
            'CopyFolder' => "ConfigWebLangFile",
            'appFolder' => 'Config/WebLangFile',
            'viewFolder' => 'ConfigWebLangFile',
            'routeFolder' => "config/",
            'routeFile' => 'WebLangFile.php',
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeConfigMeta() {
        return [
            'view' => true,
            'id' => "ConfigMeta",
            'CopyFolder' => "ConfigMeta",
            'appFolder' => 'Config/Meta',
            'viewFolder' => 'ConfigMeta',
            'routeFolder' => "config/",
            'routeFile' => 'configMeta.php',
            'migrations' => [
                '2019_12_14_000003_create_meta_tags_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configMeta.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeConfigPrivacy() {
        return [
            'view' => true,
            'id' => "ConfigPrivacy",
            'CopyFolder' => "ConfigPrivacy",
            'appFolder' => 'Config/Privacy',
            'viewFolder' => 'ConfigPrivacy',
            'routeFolder' => "config/",
            'routeFile' => 'webPrivacy.php',
            'migrations' => [
                '2019_12_14_000008_create_web_privacies_table.php',
            ],
            'seeder' => [
                'config_web_privacy.sql',
                'config_web_privacy_translations.sql'
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configPrivacy.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeConfigApps() {
        return [
            'view' => true,
            'id' => "ConfigApps",
            'CopyFolder' => "ConfigApps",
            'appFolder' => 'Config/Apps',
            'viewFolder' => 'ConfigApp',
            'routeFolder' => "config/",
            'routeFile' => 'appSetting.php',
            'migrations' => [
                '2019_12_14_000019_create_app_settings_table.php',
                '2019_12_14_000020_create_app_menus_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configApp.php'],
            'photoFolder' => ['app-photo'],

        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeConfigBranch() {
        return [
            'view' => true,
            'id' => "ConfigBranch",
            'CopyFolder' => "ConfigBranch",
            'appFolder' => 'Config/Branche',
            'viewFolder' => 'ConfigBranch',
            'routeFolder' => "config/",
            'routeFile' => 'Branch.php',
            'migrations' => [
                '2019_12_14_000017_create_branches_table.php',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configBranch.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeSiteMaps() {
        return [
            'view' => true,
            'id' => "SiteMaps",
            'CopyFolder' => "ConfigSiteMaps",
            'appFolder' => 'Config/SiteMap',
            'viewFolder' => 'ConfigSiteMap',
            'routeFolder' => "config/",
            'routeFile' => 'siteMaps.php',
            'migrations' => [
                '2019_12_14_000016_create_site_maps_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['siteMap.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeLeadsNewsLetter() {
        return [
            'view' => true,
            'id' => "LeadsNewsLetter",
            'CopyFolder' => "LeadsNewsLetter",
            'appFolder' => 'Leads/NewsLetter',
            'viewFolder' => 'LeadsNewsLetter',
            'routeFolder' => "leads/",
            'routeFile' => 'newsLetter.php',
            'migrations' => ['2019_12_14_000010_create_news_letters_table.php'],
            'seeder' => ['leads_news_letters.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['leadsNewsLetter.php'],
            'webLangFolder' => "web/",
            'webLangFiles' => ['newsletter.php'],
            'livewireClass' => ['Site' => 'NewsLetterForm.php'],
            'livewireView' => ['site' => 'news-letter-form.blade.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeLeadsContactUs() {
        return [
            'view' => true,
            'id' => "LeadsContactUs",
            'CopyFolder' => "LeadsContactUs",
            'infoFile' => "LeadsContactUs.txt",
            'appFolder' => 'Leads/ContactUs',
            'viewFolder' => 'LeadsContactUs',
            'routeFolder' => "leads/",
            'routeFile' => 'contactUs.php',
            'migrations' => ['2019_12_14_000013_create_contact_us_forms_table.php'],
            'seeder' => ['leads_contact_us.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['leadsContactUs.php'],
        ];
    }

}
