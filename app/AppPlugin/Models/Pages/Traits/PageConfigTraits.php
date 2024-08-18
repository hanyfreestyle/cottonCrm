<?php

namespace App\AppPlugin\Models\Pages\Traits;

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

}
