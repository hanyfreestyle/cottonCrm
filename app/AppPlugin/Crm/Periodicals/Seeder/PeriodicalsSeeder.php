<?php

namespace App\AppPlugin\Crm\Periodicals\Seeder;

use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\BooksTagsNotes;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PeriodicalsSeeder extends Seeder {

    public function run(): void {

        Periodicals::unguard();
        $tablePath = public_path('db/book_periodicals.sql');
        DB::unprepared(file_get_contents($tablePath));


        PeriodicalsRelease::unguard();
        $tablePath = public_path('db/book_periodicals_release.sql');
        DB::unprepared(file_get_contents($tablePath));

//        $Periodicals = Periodicals::query()->where('release_id', '!=', null)->get();
//        foreach ($Periodicals as $Periodical) {
//            $reId = $Periodical->release_id;
//            $newId = ConfigData::query()->where('old_id', $reId)->first()->id;
//            $Periodical->release_id = $newId ;
//            $Periodical->save() ;
//        }
//
//        $Periodicals = Periodicals::query()->get();
//        foreach ($Periodicals as $Periodical) {
//            $Periodical->lang_id = 1 ;
//            $Periodical->save() ;
//        }

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
            $permissions = Permission::where('cat_id', 'Periodicals')->where('name', '!=', 'Periodicals_report')->pluck('id');
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        }

    }

}
