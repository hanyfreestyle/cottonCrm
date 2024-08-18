<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeModel {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'Blog' => self::treeBlog(),
            'Faq' => self::treeFaq(),
            'Pages' => self::treePages(),
            'FileManager' => self::treeFileManager(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeBlog() {
        return [
            'view' => true,
            'id' => "Blog",
            'CopyFolder' => "Model_Blog",
            'appFolder' => 'Models/BlogPost',
            'routeFolder' => "model/",
            'routeFile' => 'blog.php',
            'migrations' => [
                '2021_01_02_000001_create_blog_model_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['blogPost.php'],
        ];

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeFileManager() {
        return [
            'view' => true,
            'id' => "FileManager",
            'CopyFolder' => "FileManager",
            'appFolder' => 'FileManager',
            'viewFolder' => 'FileManager',
            'routeFolder' => null,
            'routeFile' => 'fileManager.php',
            'migrations' => ['2019_12_14_000008_create_file_manager_table.php'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['fileManager.php'],
            'assetsFolder' => ['admin-plugins/file-manager'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeFaq() {
        return [
            'view' => true,
            'id' => "Faq",
            'CopyFolder' => "Model_Faq",
            'appFolder' => 'Models/Faq',
            'viewFolder' => 'Faq',
            'routeFolder' => "model/",
            'routeFile' => 'faq.php',
            'migrations' => [
                '2021_01_01_000001_create_faq_model_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['faq.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treePages() {
        return [
            'view' => true,
            'id' => "Pages",
            'CopyFolder' => "Model_Pages",
            'appFolder' => 'Pages',
            'viewFolder' => 'Pages',
            'routeFolder' => null,
            'routeFile' => 'pages.php',
            'migrations' => [
                '2020_01_01_000001_create_page_model_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['pages.php'],
        ];
    }
}
