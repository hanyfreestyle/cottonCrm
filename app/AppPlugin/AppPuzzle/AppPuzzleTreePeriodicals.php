<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreePeriodicals {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'Periodicals' => self::treePeriodicals(),
            'DataBookRelease' => self::DataBookRelease(),
            'DataBookLang' => self::DataBookLang(),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treePeriodicals() {
        return [
            'view' => true,
            'id' => "Periodicals",
            'CopyFolder' => "Crm_Periodicals",
            'appFolder' => 'Crm/Periodicals',
            'viewFolder' => 'BookPeriodicals',
            'routeFolder' => "crm/",
            'routeFile' => 'Periodicals.php',
            'migrations' => [
                '2021_01_01_000002_create_periodicals_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['Periodicals.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Book'],
            'ComponentFolderView' => ['app-plugin/crm/book'],
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function DataBookRelease() {
        return [
            'view' => true,
            'id' => "DataBookRelease",
            'CopyFolder' => "DataBookRelease",
            'appFolder' => 'Data/DataBookRelease',
            'routeFolder' => "data/",
            'routeFile' => 'data_BookRelease.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['BookRelease.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function DataBookLang() {
        return [
            'view' => true,
            'id' => "DataBookLang",
            'CopyFolder' => "DataBookLang",
            'appFolder' => 'Data/DataBookLang',
            'routeFolder' => "data/",
            'routeFile' => 'data_BookLang.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['BookLang.php'],
        ];
    }


}
