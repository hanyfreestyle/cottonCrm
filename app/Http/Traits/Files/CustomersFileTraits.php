<?php

namespace App\Http\Traits\Files;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use Illuminate\Support\Facades\File;

trait CustomersFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $newPer = getDefPermission('crm_customer', ['report' => true]);
            $data = array_merge($data, $newPer);
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            CrmCustomersConfigTraits::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $addLang = ['CrmCustomers' => ['id' => 'CrmCustomers', 'group' => 'admin', 'sub_dir' => 'crm', 'file_name' => 'customers', 'name_en' => 'Customers', 'name_ar' => 'العملاء']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            SeedDbFile(CrmCustomers::class, 'crm_customers.sql');
            SeedDbFile(CrmCustomersAddress::class, 'crm_customers_address.sql');
        }
    }

}
