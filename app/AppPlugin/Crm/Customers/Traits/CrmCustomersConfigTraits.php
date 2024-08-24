<?php

namespace App\AppPlugin\Crm\Customers\Traits;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use Illuminate\Support\Str;

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
    static function saveDefField($saveData, $request) {
        $saveData->evaluation_id = $request->input('evaluation_id');
        $saveData->gender_id = $request->input('gender_id');

        $saveData->name = $request->input('name');
        $saveData->mobile = $request->input('mobile');
        $saveData->mobile_code = $request->input('countryCode_mobile');

        $saveData->mobile_2 = $request->input('mobile_2');
        if ($request->input('mobile_2')) {
            $saveData->mobile_2_code = $request->input('countryCode_mobile_2');
        }

        $saveData->phone = $request->input('phone');
        if ($request->input('phone')) {
            $saveData->phone_code = $request->input('countryCode_phone');
        }

        $saveData->whatsapp = $request->input('whatsapp');
        if ($request->input('whatsapp')) {
            $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
        }

        $saveData->email = $request->input('email');
        $saveData->notes = $request->input('notes');

        return $saveData;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function saveAddressField($saveAddress, $saveData, $request) {
        $saveAddress->uuid = Str::uuid()->toString();
        $saveAddress->customer_id = $saveData->id;

        $saveAddress->country_id = $request->input('country_id');
        $saveAddress->city_id = $request->input('city_id');
        $saveAddress->area_id = $request->input('area_id');

        $saveAddress->address = $request->input('address');
        $saveAddress->floor = $request->input('floor');
        $saveAddress->post_code = $request->input('post_code');
        $saveAddress->unit_num = $request->input('unit_num');
        $saveAddress->latitude = $request->input('latitude');
        $saveAddress->longitude = $request->input('longitude');

        return $saveAddress;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CustomersSearchFilter($request) {
        if ($request->search_type == 1) {
            $rowData = CrmCustomers::query()
                ->where('mobile', $request->name)
                ->orWhere('mobile_2', $request->name)
                ->orWhere('phone', $request->name)
                ->orWhere('whatsapp', $request->name)
                ->get();
        } elseif ($request->search_type == 2) {
            $rowData = CrmCustomers::query()
                ->where('name', 'like', '%' . $request->name . '%')
                ->get();
        } elseif ($request->search_type == 3) {
            $searchString = $request->name;
            $rowData = CrmCustomers::query()->with('address')->whereHas('address', function ($query) use ($searchString) {
                $query->where('address', 'like', '%' . $searchString . '%');
            })->get();
        }
        return $rowData;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.CrmCustomer";
        $mainMenu->name = "admin/crm_customer.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "crm_customer_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("CrmCustomer");;
        $subMenu->url = "admin.CrmCustomer.index";
        $subMenu->name = "admin/crm_customer.app_menu_list";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.addNew|create|create_ar|create_en";
        $subMenu->url = "admin.CrmCustomer.addNew";
        $subMenu->name = "admin/crm_customer.app_menu_add";
        $subMenu->roleView = "crm_customer_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.search|CrmCustomer.searchFilter";
        $subMenu->url = "admin.CrmCustomer.search";
        $subMenu->name = "admin/crm_customer.app_menu_search";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-search";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.Report.index|CrmCustomer.Report.filter";
        $subMenu->url = "admin.CrmCustomer.Report.index";
        $subMenu->name = "admin/crm_customer.app_menu_report";
        $subMenu->roleView = "crm_customer_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

    }


}
