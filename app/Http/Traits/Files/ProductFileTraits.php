<?php

namespace App\Http\Traits\Files;

use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use Illuminate\Support\Facades\File;

trait ProductFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

//        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            $newPer = getDefPermission('crm_customer', true);
//            $data = array_merge($data, $newPer);
//        }

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $newPer = [
                ['cat_id' => 'Product', 'name' => 'Product_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Product', 'name' => 'Product_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Product', 'name' => 'Product_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Product', 'name' => 'Product_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Product', 'name' => 'Product_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Product', 'name' => 'Product_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
            $newPer = [
                ['cat_id' => 'orders', 'name' => 'orders_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'orders', 'name' => 'orders_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'orders', 'name' => 'orders_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'orders', 'name' => 'orders_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
            $newPer = [
                ['cat_id' => 'customer', 'name' => 'customer_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'customer', 'name' => 'customer_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'customer', 'name' => 'customer_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'customer', 'name' => 'customer_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'customer', 'name' => 'customer_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            CrmCustomersController::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $addLang = ['product' => ['id' => 'product', 'group' => 'admin', 'file_name' => 'proProduct', 'name' => 'Product', 'name_ar' => 'المنتجات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
            $addLang = ['pages' => ['id' => 'pages', 'group' => 'admin', 'file_name' => 'pages', 'name' => 'pages', 'name_ar' => 'الصفحات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
            $addLang = ['orders' => ['id' => 'orders', 'group' => 'admin', 'file_name' => 'orders', 'name' => 'Orders', 'name_ar' => 'ادارة الطلبات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
            $addLang = ['customer' => ['id' => 'customer', 'group' => 'admin', 'file_name' => 'customer', 'name' => 'Customer', 'name_ar' => 'ادارة العملاء']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {

//        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
//            $this->call(ProductCategoriesSeeder::class);
//            $this->call(ProductSeeder::class);
//        }
//
//        if (File::isFile(base_path('routes/AppPlugin/customer.php'))) {
//            $this->call(UsersCustomersSeeder::class);
//        }
//
//        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
//            $this->call(OrdersSeeder::class);
//        }

//        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            SeedDbFile(CrmCustomers::class, 'crm_customers.sql');
//            SeedDbFile(CrmCustomersAddress::class, 'crm_customers_address.sql');
//        }
    }

}
