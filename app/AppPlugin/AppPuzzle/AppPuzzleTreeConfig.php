<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeConfig {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ModelTree
    static function ConfigTree() {
        $modelTree = [

            'WebLangFile' => self::treeWebLangFile(),
            'ConfigMeta' => self::treeConfigMeta(),
            'ConfigPrivacy' => self::treeConfigPrivacy(),
            'ConfigApps' => self::treeConfigApps(),
            'ConfigBranch' => self::treeConfigBranch(),
            'SiteMaps' => self::treeSiteMaps(),
        ];

        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
#|||||||||||||||||||||||||||||||||||||| #
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
            'seeder' => [
                'config_meta_tag.sql',
                'config_meta_tag_translations.sql',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configMeta.php'],
            'ClientFolder' => config('adminConfig.app_folder'),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
#|||||||||||||||||||||||||||||||||||||| #
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

            'seeder' => [
                'config_app_menu.sql',
                'config_app_menu_translations.sql',
                'config_app_setting.sql',
                'config_app_setting_translations.sql',

            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configApp.php'],
            'photoFolder' => ['app-photo'],
            'ClientFolder' => config('adminConfig.app_folder'),

        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
            'seeder' => [
                'config_branch.sql',
                'config_branch_translations.sql',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['configBranch.php'],
            'ClientFolder' => config('adminConfig.app_folder'),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
            'seeder' => [
                'config_site_robots.sql',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['siteMap.php'],
            'ComponentFolderClass' => ['AppPlugin/GoogleCode'],
            'ComponentFolderView' => ['app-plugin/google-code'],
            'ClientFolder' => config('adminConfig.app_folder'),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


}
