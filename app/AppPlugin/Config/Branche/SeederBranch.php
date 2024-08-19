<?php

namespace App\AppPlugin\Config\Branche;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeederBranch extends Seeder {

    public function run(): void {
        $folder = config('adminConfig.app_folder');
        if (File::isFile(public_path('db/' . $folder . '/config_branch.sql'))) {

            Branch::unguard();
            $tablePath = public_path('db/' . $folder . '/config_branch.sql');
            DB::unprepared(file_get_contents($tablePath));

            BranchTranslation::unguard();
            $tablePath = public_path('db/' . $folder . '/config_branch_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }
    }

}
