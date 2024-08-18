<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeModel {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
//            'ModelMainPost' => self::treeModelMainPost(),
//            'BlogPost' => self::treeModelBlogPost(),

            'Blog' => self::treeBlog(),
            'Faq' => self::treeFaq(),
            'Pages' => self::treePages(),
            'FileManager' => self::treeFileManager(),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeModelMainPost() {
        return [
            'view' => true,
            'id' => "ModelMainPost",
            'CopyFolder' => "ModelsMainPost",
            'appFolder' => 'Models/MainPost',
            'viewFolder' => 'ModelMainPost',
            'routeFolder' => "model/",
            'routeFile' => 'mainPost.php',
            'migrations' => [
                '2019_12_14_000018_create_post_categories_table.php',
                '2019_12_14_000019_create_post_table.php',
                '2019_12_14_000020_create_post_tags_table.php',
                '2019_12_14_000021_create_post_photos_table.php',
            ],
            'seeder' => [
                'app_category.sql', 'app_category_post.sql', 'app_category_translations.sql',
                'app_photo.sql', 'app_photo_translations.sql',
                'app_post.sql', 'app_post_review.sql', 'app_post_translations.sql',
                'app_tags.sql', 'app_tags_post.sql', 'app_tags_translations.sql',
            ],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeModelBlogPost() {
        return [
            'view' => true,
            'id' => "BlogPost",
            'CopyFolder' => "ModelsBlogPost",
            'appFolder' => 'Models/BlogPost',
            'routeFolder' => "model/",
            'routeFile' => 'BlogPost.php',
            'adminLangFolder' => "admin/model/",
            'adminLangFiles' => ['blogPost.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeBlog() {
        return [
            'view' => true,
            'id' => "Blog",
            'CopyFolder' => "Model_Blog",
            'appFolder' => 'BlogPost',
            'viewFolder' => 'BlogPost',
            'routeFolder' => null,
            'routeFile' => 'blogPost.php',
            'migrations' => [
                '2021_01_02_000001_create_blog_model_table.php',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['blogPost.php'],
            'photoFolder' => ['blog-category', 'blog'],
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
            'appFolder' => 'Faq',
            'viewFolder' => 'Faq',
            'routeFolder' => null,
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
