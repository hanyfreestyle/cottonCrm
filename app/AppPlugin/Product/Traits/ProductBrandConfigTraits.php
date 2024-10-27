<?php


namespace App\AppPlugin\Product\Traits;

use App\Http\Traits\DefModelConfigTraits;

trait ProductBrandConfigTraits {

    public function LoadConfig() {

        $defConfig = DefModelConfigTraits::defConfig();

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

        $Config = array_merge($defConfig, $Config);

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
