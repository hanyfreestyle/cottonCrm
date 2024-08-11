<?php

namespace App\AppPlugin\Data\Area\Seeder;


use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AreaSeeder extends Seeder {

    public function run(): void {

        $folder = config('adminConfig.app_folder');
        if (File::isFile(public_path('db/' . $folder . '/data_area.sql'))) {
            Area::unguard();
            $tablePath = public_path('db/' . $folder . '/data_area.sql');
            DB::unprepared(file_get_contents($tablePath));

            AreaTranslation::unguard();
            $tablePath = public_path('db/' . $folder . '/data_area_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

//         Area::query()->where('country_id','!=',169)->delete();

//        $citys = City::query()->get();
//        $newId = 1;
//        foreach ($citys as $city) {
//            $oldId = $city->id;
//            $city->id = $newId;
//            $city->save();
//
//            $CityTranslations = CityTranslation::query()->where('city_id', $oldId)->get();
//            foreach ($CityTranslations as $CityTranslation) {
//                $CityTranslation->city_id = $newId;
//                $CityTranslation->save();
//            }
//
//            $CityTranslations = Area::query()->where('city_id', $oldId)->get();
//            foreach ($CityTranslations as $CityTranslation) {
//                $CityTranslation->city_id = $newId;
//                $CityTranslation->save();
//            }
//
//            $newId = $newId + 1;
//        }
//
//
//        $ares = Area::query()->get();
//        $newId = 1;
//        foreach ($ares as $are) {
//            $oldId = $are->id;
//            $are->id = $newId;
//            $are->save();
//
//            $AreaTranslations = AreaTranslation::query()->where('area_id', $oldId)->get();
//            foreach ($AreaTranslations as $AreaTranslation) {
//                $AreaTranslation->area_id = $newId;
//                $AreaTranslation->save();
//            }
//            $newId = $newId + 1;
//        }
//
//
//        $newId = 1;
//        $CityTranslations = CityTranslation::query()->get();
//        foreach ($CityTranslations as $CityTranslation) {
//            $CityTranslation->id = $newId;
//            $CityTranslation->save();
//            $newId = $newId + 1;
//        }
//
//        $newId = 1;
//        $CityTranslations = AreaTranslation::query()->get();
//        foreach ($CityTranslations as $CityTranslation) {
//            $CityTranslation->id = $newId;
//            $CityTranslation->save();
//            $newId = $newId + 1;
//        }

    }

}
