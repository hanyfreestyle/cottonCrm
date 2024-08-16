<?php


namespace App\AppPlugin\Pages\Traits;


trait PageConfigTraits {

    public function LoadConfig() {

        $config = [
            'DbCategory' => 'page_categories',
            'DbCategoryTrans' => 'page_category_translations',
            'DbCategoryForeign' => 'category_id',
            'DbPost' => 'page_pages',
            'DbPostTrans' => 'page_translations',
            'DbPostCatId' => 'page_id',
            'DbPhoto' => 'page_photos',
            'DbPhotoTrans' => 'page_photo_translations',
            'DbTags' => 'page_tags',
            'DbTagsTrans' => 'page_tags_translations',
            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/def.category_des'),
        ];
        $defConfig = getConfigFromJson('model_pages');

        $Config = array_merge($defConfig, $config);
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
