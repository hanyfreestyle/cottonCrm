<?php

namespace App\AppCore\AdminRole\Seeder;

use App\AppCore\WebSettings\Traits\WebSettingsConfigTraits;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\AppPlugin\Models\MainPost\Traits\MainPostPermissionTraits;
use App\Http\Traits\CrmFunTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {

    public function run(): void {

        $data = [
            ['cat_id' => 'users', 'name' => 'users_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'users', 'name' => 'users_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'users', 'name' => 'users_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'users', 'name' => 'users_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'users', 'name' => 'users_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],

            ['cat_id' => 'roles', 'name' => 'roles_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'roles', 'name' => 'roles_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'roles', 'name' => 'roles_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'roles', 'name' => 'roles_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ['cat_id' => 'roles', 'name' => 'roles_update_permissions', 'name_ar' => 'تعديل صلاحيات المجموعة', 'name_en' => 'Roles Update Permissions'],
        ];

        $data = CrmFunTraits::LoadPermission($data);

//        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
//            $newPer = [
//                ['cat_id' => 'Product', 'name' => 'Product_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'Product', 'name' => 'Product_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'Product', 'name' => 'Product_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'Product', 'name' => 'Product_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//                ['cat_id' => 'Product', 'name' => 'Product_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
//                ['cat_id' => 'Product', 'name' => 'Product_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
//            ];
//            $data = array_merge($data, $newPer);
//        }
//
//        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
//            $newPer = [
//                ['cat_id' => 'orders', 'name' => 'orders_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'orders', 'name' => 'orders_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'orders', 'name' => 'orders_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//                ['cat_id' => 'orders', 'name' => 'orders_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
//            ];
//            $data = array_merge($data, $newPer);
//        }
//
//        if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
//            $newPer = [
//                ['cat_id' => 'customer', 'name' => 'customer_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'customer', 'name' => 'customer_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'customer', 'name' => 'customer_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'customer', 'name' => 'customer_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//                ['cat_id' => 'customer', 'name' => 'customer_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
//            ];
//            $data = array_merge($data, $newPer);
//        }
//
//        if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {
//            $data = MainPostPermissionTraits::LoadPermission($data);
//        }

//        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {
//            $newPer = [
//                ['cat_id' => 'Blog', 'name' => 'Blog_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'Blog', 'name' => 'Blog_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'Blog', 'name' => 'Blog_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'Blog', 'name' => 'Blog_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//                ['cat_id' => 'Blog', 'name' => 'Blog_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
//                ['cat_id' => 'Blog', 'name' => 'Blog_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
//            ];
//            $data = array_merge($data, $newPer);
//        }

//        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
//            $newPer = [
//                ['cat_id' => 'Pages', 'name' => 'Pages_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'Pages', 'name' => 'Pages_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'Pages', 'name' => 'Pages_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'Pages', 'name' => 'Pages_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//                ['cat_id' => 'Pages', 'name' => 'Pages_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
//                ['cat_id' => 'Pages', 'name' => 'Pages_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
//            ];
//            $data = array_merge($data, $newPer);
//        }




//        if (File::isFile(base_path('routes/AppPlugin/faq.php'))) {
//            $newPer = [
//                ['cat_id' => 'Faq', 'name' => 'Faq_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'Faq', 'name' => 'Faq_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'Faq', 'name' => 'Faq_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'Faq', 'name' => 'Faq_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//                ['cat_id' => 'Faq', 'name' => 'Faq_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
//                ['cat_id' => 'Faq', 'name' => 'Faq_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
//            ];
//            $data = array_merge($data, $newPer);
//        }


        $data = WebSettingsConfigTraits::LoadPermission($data);
        $data = ConfigDataTraits::LoadPermission($data);


//        if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
//            $newPer = [
//                ['cat_id' => 'leads', 'name' => 'leads_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'leads', 'name' => 'leads_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'leads', 'name' => 'leads_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'leads', 'name' => 'leads_export', 'name_ar' => 'تصدير', 'name_en' => 'Export'],
//                ['cat_id' => 'leads', 'name' => 'leads_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//            ];
//            $data = array_merge($data, $newPer);
//        }

//        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
//            $newPer = [
//                ['cat_id' => 'FileManager', 'name' => 'FileManager_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
//                ['cat_id' => 'FileManager', 'name' => 'FileManager_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
//                ['cat_id' => 'FileManager', 'name' => 'FileManager_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
//                ['cat_id' => 'FileManager', 'name' => 'FileManager_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
//            ];
//            $data = array_merge($data, $newPer);
//        }


        $countData = Permission::all()->count();
        if ($countData == '0') {
            foreach ($data as $value) {
                Permission::create($value);
            }
        }

    }
}
