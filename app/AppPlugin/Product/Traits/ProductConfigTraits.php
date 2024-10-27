<?php


namespace App\AppPlugin\Product\Traits;

trait ProductConfigTraits {

    public function LoadConfig() {

        $Config = [
            'DbCategory' => 'pro_categories',
            'DbCategoryTrans' => 'pro_category_translations',

            'DbPost' => 'pro_products',
            'DbPostTrans' => 'pro_product_translations',
            'DbPostCatId' => 'product_id',
            'DbPhoto' => 'pro_product_photos',
            'DbTags' => 'pro_tags',
            'DbTagsTrans' => 'pro_tags_translations',


            'TableCategory' => true,
            'TableTags' => true,
            'TableTagsOnFly' => false,
            'TableReview' => false,

            'TableMorePhotos' => true,
            'MorePhotosEdit' => true,

            'categoryTree' => true,
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


            'postPublishedDate' => false,
            'postPhotoAdd' => true,
            'postPhotoView' => true,

            'postEditor' => true,
            'postDes' => true,
            'postSeo' => true,
            'postSlug' => true,
            'postYoutube' => true,
            'postWebSlug' => null,

            'LangPostDefName' => __('admin/faq.faq_text_name'),
            'LangPostDefDes' => __('admin/faq.faq_text_answer'),

        ];
        $config = [
            'PrefixRole' => "Blog",

            'DbCategory' => 'pro_categories',
            'DbCategoryTrans' => 'pro_category_translations',
            'DbCategoryPivot' => 'pro_category_product',
            'DbCategoryForeign' => 'category_id',


            'DbPost' => 'pro_products',
            'DbPostTrans' => 'pro_product_translations',
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

    static function DbConfig() {

        $Config = new class {
            use ProductConfigTraits;
        };

        return $Config->LoadConfig();
    }

}
