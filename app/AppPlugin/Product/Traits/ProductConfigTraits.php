<?php


namespace App\AppPlugin\Product\Traits;

trait ProductConfigTraits {

    public function LoadConfig() {
        $config = [
            'PrefixRole' => "Blog",

            'DbCategory' => 'pro_category',
            'DbCategoryTrans' => 'pro_category_lang',
            'DbCategoryPivot' => 'pro_category_pivot',
            'DbCategoryForeign' => 'category_id',

            'DbBrand' => 'pro_brand',
            'DbBrandTrans' => 'pro_brand_lang',

            'DbPost' => 'pro_product',
            'DbPostTrans' => 'pro_product_lang',
            'DbPostReview' => 'blog_post_review',
            'DbPostForeignId' => 'product_id',

            'DbPhoto' => 'pro_product_photos',
            'DbPhotoTrans' => 'blog_photo_lang',

            'DbTags' => 'pro_tags',
            'DbTagsTrans' => 'pro_tags_translations',
            'DbTagsPivot' => 'pro_tags_product',


            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),
            'LangPostDefName' => __('admin/blogPost.blog_text_name'),
            'LangPostDefDes' => __('admin/form.text_content'),

        ];

        $defConfig = getConfigFromJson('model_product');
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
            use ProductConfigTraits;
        };
        return $Config->LoadConfig();
    }

}
