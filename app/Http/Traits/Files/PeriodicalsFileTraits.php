<?php

namespace App\Http\Traits\Files;

use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Crm\Periodicals\PeriodicalsController;
use Illuminate\Support\Facades\File;

trait PeriodicalsFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            $newPer = getDefPermission('Periodicals', true);
            $data = array_merge($data, $newPer);
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            PeriodicalsController::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            $addLang = ['Periodicals' =>
                ['id' => 'Periodicals', 'group' => 'admin', 'file_name' => 'Periodicals', 'name' => 'book', 'name_ar' => 'الكتب والدوريات'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BookRelease.php'))) {
            $addLang = ['BookRelease' =>
                ['id' => 'BookRelease', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'BookRelease', 'name_en' => 'BookRelease', 'name_ar' => 'نوع الاصدار'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BookLang.php'))) {
            $addLang = ['BookLang' =>
                ['id' => 'BookLang', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'BookLang', 'name_en' => 'BookLang', 'name_ar' => 'اللغات'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            SeedDbFile(Periodicals::class, 'book_periodicals.sql');
            SeedDbFile(PeriodicalsRelease::class, 'book_periodicals_release.sql');
        }
    }

}
