<?php

namespace App\AppPlugin\AppPuzzle;

class ClientAppPuzzleTree {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'Hoover' => self::treeClientData('hoover'),
            'Hoover2' => self::treeClientData('bookcaffe'),
            'cotton' => self::treeClientData('cotton'),
            'hany' => self::treeClientData('hany'),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeClientData($folderName) {
        return [
            'view' => true,
            'folderName' => $folderName,
            'id' => $folderName,
            'CopyFolder' => "_Clients/".$folderName,
//            'appFolder' => 'Crm/ImportData',
//            'viewFolder' => 'DataImport',
//            'routeFolder' => "crm/",
//            'routeFile' => 'ImportData.php',
//            'migrations' => [
//                '2020_01_01_000001_create_import_data_table.php',
//            ],
//            'seeder' => ['config_data_import.sql'],
//            'adminLangFolder' => "admin/crm/",
//            'adminLangFiles' => ['ImportData.php'],
        ];
    }


}
