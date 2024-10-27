<?php


namespace App\AppPlugin\Product\Traits;



trait ProductBrandConfigTraits {

    public function LoadConfig() {

        $Config = [
            'DbCategory'=>'pro_brands',
            'DbCategoryTrans'=>'pro_brand_translations',
            'DbCategoryForeign'=>'brand_id',

            'TableCategory' => true,

            'categoryTree' => false,
            'categoryDeep' => 2,
            'categoryPhotoAdd' => true,
            'categoryPhotoView' => true,
            'categoryIcon' => false,
            'categoryDelete' => true,
            'categorySort' => false,
            'categoryEditor' => true,
            'categoryDes' => true,
            'categorySeo' => true,
            'categorySlug' => true,
            'categoryShowLang' => true,
            'categoryFullRow' => false,

            'LangCategoryDefName' => __('admin/proProduct.brand_text_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),

        ];

        $config = [
            'PrefixRole' => "Blog",



            'DbCategory'=>'pro_brands',
            'DbCategoryTrans'=>'pro_brand_translations',
            'DbCategoryForeign'=>'brand_id',

//            'DbPost' => 'blog_post',
//            'DbPostTrans' => 'blog_post_lang',
//            'DbPostReview' => 'blog_post_review',
//            'DbPostForeignId' => 'blog_id',
//
//            'DbPhoto' => 'blog_photo',
//            'DbPhotoTrans' => 'blog_photo_lang',
//
//            'DbTags' => 'blog_tags',
//            'DbTagsTrans' => 'blog_tags_lang',
//            'DbTagsPivot' => 'blog_tags_pivot',
//
//            'LangCategoryDefName' => __('admin/def.category_name'),
//            'LangCategoryDefDes' => __('admin/form.text_content'),
//            'LangPostDefName' => __('admin/blogPost.blog_text_name'),
//            'LangPostDefDes' => __('admin/form.text_content'),

        ];

        $defConfig = getConfigFromJson('model_product_brand');
        $Config = array_merge($config, $defConfig);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

    static function DbConfig() {

        $Config = new class {
            use ProductBrandConfigTraits;
        };

        return $Config->LoadConfig();
    }

}
