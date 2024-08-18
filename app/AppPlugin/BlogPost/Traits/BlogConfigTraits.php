<?php

namespace App\AppPlugin\BlogPost\Traits;


trait BlogConfigTraits {

    public function LoadConfig() {

        $config = [
            'PrefixRole' => "Blog",

            'DbCategory' => 'blog_category',
            'DbCategoryTrans' => 'blog_category_translations',
            'DbCategoryPivot' => 'blog_category_t_pivot',
            'DbCategoryForeign' => 'category_id',


            'DbPost' => 'blog_post',
            'DbPostTrans' => 'blog_post_translations',
            'DbPostReview' => 'blog_post_t_review',
            'DbPostForeignId' => 'blog_id',

            'DbPhoto' => 'blog_photo',
            'DbPhotoTrans' => 'blog_photo_translations',

            'DbTags' => 'blog_tags',
            'DbTagsTrans' => 'blog_tags_translations',
            'DbTagsPivot' => 'blog_tags_t_pivot',

            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),
            'LangPostDefName' => __('admin/blogPost.blog_text_name'),
            'LangPostDefDes' => __('admin/form.text_content'),

        ];

        $defConfig = getConfigFromJson('model_blog');
        $Config = array_merge($config, $defConfig);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

    static function DbConfig() {
        $Config = new class {
            use BlogConfigTraits;
        };
        return $Config->LoadConfig();
    }

}
