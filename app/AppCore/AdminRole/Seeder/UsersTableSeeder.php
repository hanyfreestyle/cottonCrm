<?php


namespace App\AppCore\AdminRole\Seeder;

use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder {

    public function run(): void {
        $users = [
            [
                'name' => 'احمد عبادى',
                'slug' => AdminHelper::Url_Slug('احمد عبادى'),
                'email' => 'sales@cottton.shop',
                'crm_tech' => 1,
                'password' => Hash::make('sales@cottton.shop'),
                'roles_name' => ['editor'],
            ],
            [
                'name' => 'Mohamed Naser',
                'slug' => AdminHelper::Url_Slug('Mohamed Naser'),
                'email' => 'editor@cottton.shop',
                'crm_tech' => 1,
                'password' => Hash::make('editor@cottton.shop'),
                'roles_name' => ['editor'],
            ],
        ];
        $userCount = User::all()->count();
        if ($userCount == '1') {
            foreach ($users as $key => $value) {
                $user = User::create($value);
                $role = Role::findByName('editor');
                $permissions = Permission::where('cat_id', 'Product')->pluck('id');
                $role->syncPermissions($permissions);
                $user->assignRole([$role->id]);
            }
        }
    }
}
