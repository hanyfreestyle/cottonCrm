<?php


namespace App\AppPlugin\Faq\Traits;


trait FaqConfigTraits {

    public function LoadConfig() {
        $config = [
            'PrefixRole' => "Faq",

            'DbCategory' => 'faq_category',
            'DbCategoryTrans' => 'faq_category_translations',
            'DbCategoryPivot' => 'faq_category_faq',
            'DbCategoryForeign' => 'category_id',

            'DbPost' => 'faq_faqs',
            'DbPostTrans' => 'faq_translations',
            'DbPostForeignId' => 'faq_id',

            'DbPhoto' => 'faq_photos',
            'DbPhotoTrans' => 'faq_photo_translations',

            'DbTags' => 'faq_tags',
            'DbTagsTrans' => 'faq_tags_translations',
            'DbTagsPivot' => 'faq_tags_translations',

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
