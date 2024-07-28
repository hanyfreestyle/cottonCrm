<?php
namespace App\AppPlugin\Data\Area\Seeder;


use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder {

    public function run(): void {

        Area::unguard();
        $tablePath = public_path('db/data_area.sql');
        DB::unprepared(file_get_contents($tablePath));

        AreaTranslation::unguard();
        $tablePath = public_path('db/data_area_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
