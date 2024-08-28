<?php

namespace App\AppCore\AdminRole\Seeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {

    public function run(): void {

        $data = [
            ['name' => 'supervisor', 'name_ar' => 'مشرف عام', 'name_en' => 'Supervisor'],
            ['name' => 'technician', 'name_ar' => 'فنى صيانة', 'name_en' => 'Technician'],
            ['name' => 'data_entry', 'name_ar' => 'اضافة الطلبات', 'name_en' => 'Data Entry'],
            ['name' => 'customer_service', 'name_ar' => 'خدمة العملاء', 'name_en' => 'Customer service'],
        ];

        $countData = Role::all()->count();
        if($countData == '1') {
            foreach ($data as $key => $value) {
                Role::create($value);
            }
        }
    }

}
