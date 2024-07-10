<?php

namespace App\AppPlugin\Crm\Periodicals\Seeder;

use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PeriodicalsSeeder extends Seeder {

    public function run(): void {

        Periodicals::unguard();
        $tablePath = public_path('db/book_periodicals.sql');
        DB::unprepared(file_get_contents($tablePath));

        PeriodicalsRelease::unguard();
        $tablePath = public_path('db/book_periodicals_release.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
