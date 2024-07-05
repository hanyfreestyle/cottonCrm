<?php
namespace App\AppPlugin\Data\Country;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederCountry extends Seeder {

    public function run(): void {

        Country::unguard();
        $tablePath = public_path('db/data_countries.sql');
        DB::unprepared(file_get_contents($tablePath));

        CountryTranslation::unguard();
        $tablePath = public_path('db/data_country_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
