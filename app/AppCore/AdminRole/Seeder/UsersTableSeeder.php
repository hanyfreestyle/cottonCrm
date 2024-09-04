<?php


namespace App\AppCore\AdminRole\Seeder;

use App\Helpers\AdminHelper;
use App\Models\User;
use App\Models\UserBack;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder {

    public function run(): void {


        $online = true;
        SeedDbFile(UserBack::class, 'users_back.sql');

        if ($online) {

            $oldUsers = UserBack::query()->where('id', '!=', 1)->get();

            foreach ($oldUsers as $old) {
                $user = new User();
                $user->name = $old->name;
                $user->slug = $old->slug;
                $user->email = $old->email;
                $user->password = $old->password;
                $user->des = $old->des;
                $user->crm_tech = $old->crm_tech;
                $user->roles_name = $old->roles_name;
                $user->save();

                $role = Role::findByName('technician');
                $permissions = Permission::where('cat_id', 'crm_service_follow')->pluck('id');
//                dd($permissions);
                $permissions = ['22','23','24'];
                $role->syncPermissions($permissions);
                $user->assignRole([$role->id]);
            }

        } else {
            $oldUsers = DB::connection('mysql2')->table('tbl_user')->where('user_id', '!=', 1)->get();

            foreach ($oldUsers as $old) {
                $user = new User();
                $user->name = $old->name;
                $user->slug = AdminHelper::Url_Slug($old->user_name);
                $user->email = $old->user_name."@hoover-eg.com";
                $user->password = Hash::make($old->user_name."@hoover-eg.com");
                $user->des = null;

                $user->roles_name = ['technician'];
                $user->crm_tech = 1;
                $user->save();

                $role = Role::findByName('technician');
                $permissions = Permission::where('cat_id', 'crm_service_follow')->pluck('id');
                $role->syncPermissions($permissions);
                $user->assignRole([$role->id]);

                if($old->group_id == 2){

                }


            }
        }
     }
}
