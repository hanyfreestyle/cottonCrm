<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrm {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ProductTree
    static function CrmTree() {
        $modelTree = [
            'ImportData' => self::treeImportData(),
            'CrmCustomers' => self::treeCrmCustomers(),
            'CrmLeads' => self::treeCrmLeads(),
            'CrmTickets' => self::treeCrmTickets(),
            'Periodicals' => self::treePeriodicals(),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
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
            'seeder' => [
                'book_periodicals.sql',
                'book_periodicals_release.sql',
                'book_tags.sql',
                'book_periodicals_notes.sql',
                'book_tags_notes.sql',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['Periodicals.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Book'],
            'ComponentFolderView' => ['app-plugin/crm/book'],
        ];
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
            'seeder' => ['crm_customers.sql', 'crm_customers_address.sql'],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['customers.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Customers'],
            'ComponentFolderView' => ['app-plugin/crm/customers'],
            'ClientFolder' => config('adminConfig.app_folder'),

        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmTickets() {
        return [
            'view' => true,
            'id' => "CrmTickets",
            'CopyFolder' => "Crm_Tickets",
            'appFolder' => 'Crm/Tickets',
            'viewFolder' => 'CrmTickets',
            'routeFolder' => "crm/",
            'routeFile' => 'ticket.php',
            'migrations' => [
                '2021_01_01_000002_create_crm_tickets_table.php',
            ],
            'seeder' => ['crm_ticket.sql', 'crm_ticket_des.sql'],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['ticket.php'],
//            'ComponentFolderClass' => ['AppPlugin/Crm/Customers'],
//            'ComponentFolderView' => ['app-plugin/crm/customers'],
            'ClientFolder' => config('adminConfig.app_folder'),

        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmLeads() {
        return [
            'view' => true,
            'id' => "CrmLeads",
            'CopyFolder' => "Crm_Leads",
            'appFolder' => 'Crm/Leads',
            'viewFolder' => 'CrmLeads',
            'routeFolder' => "crm/",
            'routeFile' => 'leads.php',
//            'migrations' => [
//                '2021_01_01_000002_create_crm_tickets_table.php',
//            ],
//            'seeder' => ['crm_ticket.sql', 'crm_ticket_des.sql'],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['leads.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Leads'],
            'ComponentFolderView' => ['app-plugin/crm/leads'],
            'ClientFolder' => config('adminConfig.app_folder'),
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
