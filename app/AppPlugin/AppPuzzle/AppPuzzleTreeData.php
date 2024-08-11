<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeData {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'ConfigData' => self::treeConfigData(),
            'DataCountry' => self::treeDataCountry(),
            'DataCity' => self::treeDataCity(),
            'DataArea' => self::treeDataArea(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeConfigData() {
        return [
            'view' => true,
            'id' => "ConfigData",
            'CopyFolder' => "ConfigData",
            'appFolder' => 'Data/ConfigData',
            'viewFolder' => 'ConfigData',
            'routeFolder' => "data/",
            'routeFile' => 'configData.php',
            'migrations' => ['2019_12_14_000017_create_data_table.php'],
            'seeder' => ['config_data.sql', 'config_data_translations.sql'],
            'ClientFolder' => config('adminConfig.app_folder'),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeDataCountry() {
        return [
            'view' => true,
            'id' => "DataCountry",
            'CopyFolder' => "DataCountry",
            'appFolder' => 'Data/Country',
            'viewFolder' => 'DataCountry',
            'routeFolder' => "data/",
            'routeFile' => 'country.php',
            'migrations' => ['2019_12_14_000014_create_countries_table.php'],
            'seeder' => ['data_countries.sql', 'data_country_translations.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dataCountry.php'],
//            'assetsFolder' => ['flag'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeDataCity() {

        return [
            'view' => true,
            'id' => "DataCity",
            'CopyFolder' => "DataCity",
            'appFolder' => 'Data/City',
            'viewFolder' => 'DataCity',
            'routeFolder' => "data/",
            'routeFile' => 'city.php',
            'migrations' => ['2019_12_14_000015_create_cities_table.php'],
            'seeder' => ['data_city.sql', 'data_city_translations.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dataCity.php'],
            'ClientFolder' => config('adminConfig.app_folder'),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeDataArea() {
        return [
            'view' => true,
            'id' => "DataArea",
            'CopyFolder' => "DataArea",
            'appFolder' => 'Data/Area',
            'viewFolder' => 'DataArea',
            'routeFolder' => "data/",
            'routeFile' => 'area.php',
            'migrations' => ['2019_12_14_000016_create_area_table.php'],
            'seeder' => ['data_area.sql', 'data_area_translations.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dataArea.php'],
            'ClientFolder' => config('adminConfig.app_folder'),
        ];
    }


}
