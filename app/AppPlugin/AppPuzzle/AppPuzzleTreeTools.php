<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeTools {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'ImportData' => self::treeImportData(),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeImportData() {
        return [
            'view' => true,
            'id' => "ImportData",
            'CopyFolder' => "Crm_ImportData",
            'appFolder' => 'Crm/ImportData',
            'viewFolder' => 'DataImport',
            'routeFolder' => "crm/",
            'routeFile' => 'ImportData.php',
            'migrations' => [
                '2020_01_01_000001_create_import_data_table.php',
            ],
            'seeder' => ['config_data_import.sql'],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['ImportData.php'],
        ];
    }


}
