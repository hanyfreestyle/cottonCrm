<?php


namespace App\AppPlugin\Faq\Traits;

use App\Http\Traits\DefModelConfigTraits;

trait FaqConfigTraits {

    public function LoadConfig() {

        $defConfig = DefModelConfigTraits::defConfig();

        $Config = [
            'DbCategory'=>'faq_category',
            'DbCategoryTrans'=>'faq_category_translations',
            'DbPost'=>'faq_faqs',
            'DbPostTrans'=>'faq_translations',
            'DbPostCatId'=>'faq_id',
            'DbPhoto'=>'faq_photos',
            'DbPhotoTrans'=>'faq_photo_translations',
            'DbTags'=>'faq_tags',
            'DbTagsTrans'=>'faq_tags_translations',


            'TableCategory' => true,
            'TableTags' => true,
            'TableTagsOnFly' => false,
            'TableReview' => false,

            'TableMorePhotos' => true,
            'MorePhotosEdit' => true,

            'categoryTree' => true,
            'categoryPhotoAdd' => true,
            'categoryPhotoView' => true,
            'categoryIcon' => false,
            'categoryDelete' => true,
            'categorySort' => false,

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
            use FaqConfigTraits;
        };

        return $Config->LoadConfig();
    }

}
