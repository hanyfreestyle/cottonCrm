<?php

namespace App\AppCore\DefPhoto;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DefPhotoSeeder extends Seeder {

    public function run(): void {
        $folder = config('adminConfig.app_folder');

        if ($folder) {
            DefPhoto::unguard();
            $tablePath = public_path('db/' . $folder . '/config_def_photos.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

    }
}
