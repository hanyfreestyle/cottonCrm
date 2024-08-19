<?php

namespace App\AppPlugin\Models\Faq\Traits;

use App\AppCore\Menu\AdminMenu;

trait FaqConfigTraits {

    public function LoadConfig() {
        $config = [
            'PrefixRole' => "Faq",

            'DbCategory' => 'faq_category',
            'DbCategoryTrans' => 'faq_category_lang',
            'DbCategoryPivot' => 'faq_category_pivot',
            'DbCategoryForeign' => 'category_id',

            'DbPost' => 'faq_post',
            'DbPostTrans' => 'faq_post_lang',
            'DbPostReview' => 'faq_post_review',
            'DbPostForeignId' => 'faq_id',

            'DbPhoto' => 'faq_photo',
            'DbPhotoTrans' => 'faq_photo_lang',

            'DbTags' => 'faq_tags',
            'DbTagsTrans' => 'faq_tags_lang',
            'DbTagsPivot' => 'faq_tags_pivot',

            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/def.category_des'),
            'LangPostDefName' => __('admin/faq.faq_text_name'),
            'LangPostDefDes' => __('admin/faq.faq_text_answer'),

        ];

        $defConfig = getConfigFromJson('model_faq');

        $Config = array_merge($config, $defConfig);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function DbConfig() {
        $Config = new class {
            use FaqConfigTraits;
        };
        return $Config->LoadConfig();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getPermission($data) {
        $perArr = ['restore' => true, 'slug' => true, 'teamLeader' => true];
        $newPer = getDefPermission('Faq', $perArr);
        $data = array_merge($data, $newPer);
        return $data;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getAdminMenu() {
        $Config = self::DbConfig();
        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Faq";
        $mainMenu->name = "admin/faq.app_menu";
        $mainMenu->icon = "fas fa-question-circle";
        $mainMenu->roleView = "Faq_view";
        $mainMenu->save();

        if ($Config['TableCategory']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("FaqCategory");
            $subMenu->url = "admin.Faq.FaqCategory.index";
            $subMenu->name = "admin/faq.app_menu_category";
            $subMenu->roleView = "Faq_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("Question");
        $subMenu->url = "admin.Faq.Question.index";
        $subMenu->name = "admin/faq.app_menu_faq";
        $subMenu->roleView = "Faq_view";
        $subMenu->icon = "fas fa-question";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Question.createNew";
        $subMenu->url = "admin.Faq.Question.createNew";
        $subMenu->name = "admin/faq.app_menu_add_faq";
        $subMenu->roleView = "Faq_view";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        if ($Config['TableTags']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "FaqTags.index|FaqTags.edit|FaqTags.create|FaqTags.config";
            $subMenu->url = "admin.Faq.FaqTags.index";
            $subMenu->name = "admin/faq.app_menu_tags";
            $subMenu->roleView = "Faq_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }

    }


}
