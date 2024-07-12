<?php

namespace App\AppPlugin\Crm\Periodicals\Seeder;

use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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

    }

}
