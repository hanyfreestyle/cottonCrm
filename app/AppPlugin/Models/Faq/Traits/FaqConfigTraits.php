<?php

namespace App\AppPlugin\Models\Faq\Traits;

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

    static function DbConfig() {

        $Config = new class {
            use FaqConfigTraits;
        };

        return $Config->LoadConfig();
    }

}
