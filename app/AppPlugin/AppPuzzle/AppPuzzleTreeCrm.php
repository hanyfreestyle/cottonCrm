<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrm {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ProductTree
    static function CrmTree() {
        $modelTree = [
            'ImportData' => self::treeImportData(),
            'CrmCustomers' => self::treeCrmCustomers(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeCrmCustomers() {
        return [
            'view' => true,
            'id' => "CrmCustomers",
            'CopyFolder' => "Crm_Customers",
            'appFolder' => 'Crm/Customers',
            'viewFolder' => 'CrmCustomer',
            'routeFolder' => "crm/",
            'routeFile' => 'customers.php',
            'migrations' => [
                '2021_01_01_000001_create_crm_customers_table.php',
            ],
            'seeder' => ['crm_customers.sql', 'crm_customers_address.sql'],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['customers.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Customers'],
            'ComponentFolderView' => ['app-plugin/crm/customers'],

        ];
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
