<?php

namespace App\AppPlugin\Models\BlogPost\Traits;


use App\AppCore\Menu\AdminMenu;

trait BlogConfigTraits {

    public function LoadConfig() {

        $config = [
            'PrefixRole' => "Blog",

            'DbCategory' => 'blog_category',
            'DbCategoryTrans' => 'blog_category_lang',
            'DbCategoryPivot' => 'blog_category_pivot',
            'DbCategoryForeign' => 'category_id',


            'DbPost' => 'blog_post',
            'DbPostTrans' => 'blog_post_lang',
            'DbPostReview' => 'blog_post_review',
            'DbPostForeignId' => 'blog_id',

            'DbPhoto' => 'blog_photo',
            'DbPhotoTrans' => 'blog_photo_lang',

            'DbTags' => 'blog_tags',
            'DbTagsTrans' => 'blog_tags_lang',
            'DbTagsPivot' => 'blog_tags_pivot',

            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),
            'LangPostDefName' => __('admin/blogPost.blog_text_name'),
            'LangPostDefDes' => __('admin/form.text_content'),

        ];

        $defConfig = getConfigFromJson('model_blog');
        $Config = array_merge($config, $defConfig);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

    static function DbConfig() {
        $Config = new class {
            use BlogConfigTraits;
        };
        return $Config->LoadConfig();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getPermission($data) {
        $perArr = ['restore' => true, 'slug' => true, 'teamLeader' => true];
        $newPer = getDefPermission('Blog', $perArr);
        $data = array_merge($data, $newPer);
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getLangFile() {

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getAdminMenu() {

        $Config = self::DbConfig();

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Blog";
        $mainMenu->name = "admin/blogPost.app_menu";
        $mainMenu->icon = "fab fa-blogger";
        $mainMenu->roleView = "Blog_view";
        $mainMenu->save();

        if ($Config['TableCategory']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("BlogCategory");
            $subMenu->url = "admin.Blog.BlogCategory.index";
            $subMenu->name = "admin/blogPost.app_menu_category";
            $subMenu->roleView = "Blog_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BlogPost.index|BlogPost.edit|BlogPost.editEn|BlogPost.editAr";
        $subMenu->url = "admin.Blog.BlogPost.index";
        $subMenu->name = "admin/blogPost.app_menu_blog";
        $subMenu->roleView = "Blog_view";
        $subMenu->icon = "fas fa-rss";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BlogPost.create";
        $subMenu->url = "admin.Blog.BlogPost.create";
        $subMenu->name = "admin/blogPost.app_menu_add_blog";
        $subMenu->roleView = "Blog_view";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();


        if ($Config['TableTags']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "BlogTags.index|BlogTags.edit|BlogTags.create|BlogTags.config";
            $subMenu->url = "admin.Blog.BlogTags.index";
            $subMenu->name = "admin/blogPost.app_menu_tags";
            $subMenu->roleView = "Blog_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }

    }

}
