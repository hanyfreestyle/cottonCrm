<?php

namespace App\AppPlugin\Models\Pages\Traits;

use App\AppCore\Menu\AdminMenu;

trait PageConfigTraits {

    public function LoadConfig() {
        $config = [
            'PrefixRole' => "Pages",

            'DbCategory' => 'page_category',
            'DbCategoryTrans' => 'page_category_lang',
            'DbCategoryPivot' => 'page_category_pivot',
            'DbCategoryForeign' => 'category_id',

            'DbPost' => 'page_post',
            'DbPostTrans' => 'page_post_lang',
            'DbPostReview' => 'page_post_review',
            'DbPostForeignId' => 'page_id',

            'DbPhoto' => 'page_photo',
            'DbPhotoTrans' => 'page_photo_lang',

            'DbTags' => 'page_tags',
            'DbTagsTrans' => 'page_tags_lang',
            'DbTagsPivot' => 'page_tags_pivot',

            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/def.category_des'),
            'LangPostDefName' => __('admin/pages.form_name'),
            'LangPostDefDes' => __('admin/pages.form_des'),
        ];

        $defConfig = getConfigFromJson('model_pages');

        $Config = array_merge($config, $defConfig);
        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

    static function DbConfig() {
        $Config = new class {
            use PageConfigTraits;
        };
        return $Config->LoadConfig();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getPermission($data) {
        $perArr = ['restore' => true, 'slug' => true, 'teamLeader' => true];
        $newPer = getDefPermission('Pages', $perArr);
        $data = array_merge($data, $newPer);
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getAdminMenu() {

        $Config = self::DbConfig();

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Pages";
        $mainMenu->name = "admin/pages.app_menu";
        $mainMenu->icon = "fab fa-html5";
        $mainMenu->roleView = "Pages_view";
        $mainMenu->save();

        if (IsConfig($Config, 'TableCategory')) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("PageCategory");
            $subMenu->url = "admin.Pages.PageCategory.index";
            $subMenu->name = "admin/pages.app_menu_category";
            $subMenu->roleView = "Pages_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("PageList");
        $subMenu->url = "admin.Pages.PageList.index";
        $subMenu->name = "admin/pages.app_menu_page";
        $subMenu->roleView = "Pages_view";
        $subMenu->icon = "fas fa-file-code";
        $subMenu->save();


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "PageList.createNew";
        $subMenu->url = "admin.Pages.PageList.createNew";
        $subMenu->name = "admin/pages.app_menu_add_page";
        $subMenu->roleView = "Pages_add";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        if (IsConfig($Config, 'TableTags')) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PageTags.index|PageTags.edit|PageTags.create|PageTags.config";
            $subMenu->url = "admin.Pages.PageTags.index";
            $subMenu->name = "admin/pages.app_menu_tags";
            $subMenu->roleView = "Pages_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }
    }

}
