<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrm {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'CrmCustomers' => self::treeCrmCustomers(),
            'CrmCore' => self::treeCrmCore(),
            'LeadCategory' => self::treeLeadCategory(),
            'LeadSours' => self::treeLeadSours(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
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
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['customers.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Customers'],
            'ComponentFolderView' => ['app-plugin/crm/customers'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmCore() {
        return [
            'view' => true,
            'id' => "CrmCore",
            'CopyFolder' => "Crm_Core",
            'appFolder' => 'Crm/CrmCore',
            'viewFolder' => 'CrmCore',
            'routeFolder' => "crm/",
            'routeFile' => 'crmCore.php',
//            'migrations' => [
//                '2021_01_01_000001_create_crm_customers_table.php',
//            ],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['crm.php'],
//            'ComponentFolderClass' => ['AppPlugin/Crm/Customers'],
//            'ComponentFolderView' => ['app-plugin/crm/customers'],
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeLeadCategory() {
        return [
            'view' => true,
            'id' => "LeadCategory",
            'CopyFolder' => "DataLeadCategory",
            'appFolder' => 'Data/DataLeadCategory',
            'routeFolder' => "data/",
            'routeFile' => 'data_LeadCategory.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['LeadCategory.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeLeadSours() {
        return [
            'view' => true,
            'id' => "LeadSours",
            'CopyFolder' => "DataLeadSours",
            'appFolder' => 'Data/DataLeadSours',
            'routeFolder' => "data/",
            'routeFile' => 'data_LeadSours.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['LeadSours.php'],
        ];
    }

}
