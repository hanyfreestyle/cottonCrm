<?php

namespace App\AppPlugin\Data\ConfigData\Seeder;


use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigDataSeeder extends Seeder {

    public function run(): void {

        $folder = config('adminConfig.app_folder');

        if ($folder) {

            ConfigData::unguard();
            $tablePath = public_path('db/' . $folder . '/config_data.sql');
            DB::unprepared(file_get_contents($tablePath));

            ConfigDataTranslation::unguard();
            $tablePath = public_path('db/' . $folder . '/config_data_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

//        ConfigData::query()->whereNotIn('cat_id',['BookRelease','BookLang'])->delete();


//        $oldData = ConfigData::query()->orderBy('cat_id')->get();
//        $newId = 1;
//        foreach ($oldData as $data) {
//            $oldId = $data->id;
//            $data->id = $newId;
//            $data->old_id = $oldId;
//            $data->save();
//            $ConfigDataTranslation = ConfigDataTranslation::query()->where('data_id',$oldId)->get();
//            foreach ($ConfigDataTranslation as $trans){
//                $trans->data_id = $newId ;
//                $trans->save() ;
//            }
//            $newId = $newId + 1;
//        }
//
//        $ConfigDataTranslation = ConfigDataTranslation::query()->orderBy('data_id')->get();
//        $newId = 1;
//        foreach ($ConfigDataTranslation as $trans){
//            $trans->id = $newId ;
//            $trans->save() ;
//            $newId = $newId + 1;
//        }


    }

}
