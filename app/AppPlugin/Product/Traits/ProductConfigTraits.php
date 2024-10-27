<?php


namespace App\AppPlugin\Product\Traits;

use App\Http\Traits\DefModelConfigTraits;

trait ProductConfigTraits {

    public function LoadConfig() {

        $defConfig = DefModelConfigTraits::defConfig();

        $Config = [
            'DbCategory'=>'pro_categories',
            'DbCategoryTrans'=>'pro_category_translations',

            'DbPost'=>'pro_products',
            'DbPostTrans'=>'pro_product_translations',
            'DbPostCatId'=>'product_id',
            'DbPhoto'=>'pro_product_photos',
//            'DbPhotoTrans'=>'faq_photo_translations',
            'DbTags'=>'pro_tags',
            'DbTagsTrans'=>'pro_tags_translations',


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
        $Config = array_merge($defConfig, $Config);

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
