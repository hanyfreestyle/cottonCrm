<?php

namespace App\Http\Traits\Files;

use App\AppPlugin\FileManager\FileBrowserController;
use App\AppPlugin\Models\BlogPost\Traits\BlogConfigTraits;
use App\AppPlugin\Models\Faq\Traits\FaqConfigTraits;
use App\AppPlugin\Models\Pages\Traits\PageConfigTraits;
use Illuminate\Support\Facades\File;

trait MainModelFileTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $data = BlogConfigTraits::getPermission($data);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
            $data = PageConfigTraits::getPermission($data);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
            $data = FaqConfigTraits::getPermission($data);
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            $newPer = getDefPermission('FileManager');
            $data = array_merge($data, $newPer);
        }

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {

        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            BlogConfigTraits::getAdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
            PageConfigTraits::getAdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
            FaqConfigTraits::getAdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            FileBrowserController::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
            $addLang = ['pages' => ['id' => 'pages', 'group' => 'admin', 'file_name' => 'pages', 'name' => 'pages', 'name_ar' => 'الصفحات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
            $addLang = ['faq' => ['id' => 'faq', 'group' => 'admin', 'file_name' => 'faq', 'name' => 'Faq', 'name_ar' => 'الاسئلة المتكررة'],];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            $addLang = ['fileManager' => ['id' => 'fileManager', 'group' => 'admin', 'file_name' => 'fileManager', 'name' => 'fileManager', 'name_ar' => 'ميديا فايل']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $addLang = ['blogPost' => ['id' => 'blogPost', 'group' => 'admin', 'file_name' => 'blogPost', 'name' => 'Blog Post', 'name_ar' => 'المقالات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }

}
