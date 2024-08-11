<?php

namespace App\AppCore\AdminRole\Seeder;

use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\CustomersFileTraits;
use App\Http\Traits\Files\DataFileTraits;
use App\Http\Traits\Files\HooverTicketsFileTraits;
use App\Http\Traits\Files\MainModelFileTraits;
use App\Http\Traits\Files\PeriodicalsFileTraits;
use App\Http\Traits\Files\ProductFileTraits;
use Illuminate\Database\Seeder;
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

        $data = PeriodicalsFileTraits::LoadPermission($data);
        $data = CustomersFileTraits::LoadPermission($data);
        $data = HooverTicketsFileTraits::LoadPermission($data);
        $data = ProductFileTraits::LoadPermission($data);
        $data = MainModelFileTraits::LoadPermission($data);

        $data = DataFileTraits::LoadPermission($data);
        $data = AppSettingFileTraits::LoadPermission($data);

        $countData = Permission::all()->count();
        if ($countData == '0') {
            foreach ($data as $value) {
                Permission::create($value);
            }
        }

    }
}
