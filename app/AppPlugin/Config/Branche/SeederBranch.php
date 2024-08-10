<?php

namespace App\AppPlugin\Config\Branche;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederBranch extends Seeder {

    public function run(): void {

        Branch::unguard();
        $tablePath = public_path('db/config_branches.sql');
        DB::unprepared(file_get_contents($tablePath));

        BranchTranslation::unguard();
        $tablePath = public_path('db/config_branch_translations.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
    
}
