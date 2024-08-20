<?php

namespace App\AppPlugin\Crm\Customers\Traits;

use App\AppCore\Menu\AdminMenu;

trait CrmCustomersConfigTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function defConfig() {

        $config = [
            'defCountry' => config('app.defCountry'),
            'defCountryId' => config('app.defCountryId'),
            'addCountry' => true,
            'OneCountry' => false,
            'addressReq' => true,
            'googleAddress' => true,
            'postcode' => false,

            'phoneAreaCode' => true,
            'fullAddress' => true,
            'evaluation' => true,
            'gender' => true,

            'list_flag' => false,
            'list_evaluation' => true,
        ];

        $appConfig = loadConfigFromJson('crm_customers', $config);
        $config = array_merge($config, $appConfig);

        return $config;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.CrmCustomer";
        $mainMenu->name = "admin/crm/customers.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "crm_customer_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("CrmCustomer");;
        $subMenu->url = "admin.CrmCustomer.index";
        $subMenu->name = "admin/crm/customers.app_menu_list";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.addNew";
        $subMenu->url = "admin.CrmCustomer.addNew";
        $subMenu->name = "admin/crm/customers.app_menu_add";
        $subMenu->roleView = "crm_customer_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.search|CrmCustomer.searchFilter";
        $subMenu->url = "admin.CrmCustomer.search";
        $subMenu->name = "admin/crm/customers.app_menu_search";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-search";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.Report.index|CrmCustomer.Report.filter";
        $subMenu->url = "admin.CrmCustomer.Report.index";
        $subMenu->name = "admin/crm/customers.app_menu_report";
        $subMenu->roleView = "crm_customer_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }


}
