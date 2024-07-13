<?php

namespace App\AppPlugin\Crm\Periodicals\Seeder;

use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PeriodicalsSeeder extends Seeder {

    public function run(): void {

        BooksTags::unguard();
        $tablePath = public_path('db/book_tags.sql');
        DB::unprepared(file_get_contents($tablePath));

        PeriodicalsNotes::unguard();
        $tablePath = public_path('db/book_periodicals.sql');
        DB::unprepared(file_get_contents($tablePath));

        PeriodicalsRelease::unguard();
        $tablePath = public_path('db/book_periodicals_release.sql');
        DB::unprepared(file_get_contents($tablePath));

        PeriodicalsRelease::unguard();
        $tablePath = public_path('db/book_periodicals_notes.sql');
        DB::unprepared(file_get_contents($tablePath));



        $users = [
            [
                'name' => 'احمد الشيخ',
                'slug' => AdminHelper::Url_Slug('احمد الشيخ'),
                'email' => 'book@bookcaffe.com',
                'password' => Hash::make('book@bookcaffe.com'),
                'roles_name' => ['editor'],
            ],

        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $role = Role::findByName('editor');
            $permissions = Permission::where('cat_id', 'Periodicals')->pluck('id');
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        }

    }

}
