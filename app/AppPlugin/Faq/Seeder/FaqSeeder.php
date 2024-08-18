<?php

namespace App\AppPlugin\Faq\Seeder;

use App\AppPlugin\Faq\Models\Faq;
use App\AppPlugin\Faq\Models\FaqCategory;
use App\AppPlugin\Faq\Models\FaqCategoryTranslation;
use App\AppPlugin\Faq\Models\FaqPhoto;
use App\AppPlugin\Faq\Models\FaqPhotoTranslation;
use App\AppPlugin\Faq\Models\FaqPivot;
use App\AppPlugin\Faq\Models\FaqTags;
use App\AppPlugin\Faq\Models\FaqTagsPivot;
use App\AppPlugin\Faq\Models\FaqTagsTranslation;
use App\AppPlugin\Faq\Models\FaqTranslation;
use App\AppPlugin\Faq\Traits\FaqConfigTraits;
use App\AppPlugin\Pages\Traits\PageConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqSeeder extends Seeder {

    public function run(): void {
        $config = FaqConfigTraits::DbConfig();
        SeedDbFile(FaqCategory::class, $config['DbCategory'] . ".sql");
        SeedDbFile(FaqCategoryTranslation::class, $config['DbCategoryTrans'] . ".sql");
        SeedDbFile(FaqTags::class, $config['DbTags'] . '.sql');
        SeedDbFile(FaqTagsTranslation::class, $config['DbTagsTrans'] . '.sql');
        SeedDbFile(Faq::class, $config['DbPost'] . '.sql');
        SeedDbFile(FaqTranslation::class, $config['DbPostTrans'] . '.sql');
        SeedDbFile(FaqPivot::class, $config['DbCategoryPivot'] . '.sql');
        SeedDbFile(FaqTagsPivot::class, $config['DbTagsPivot'] . '.sql');
        SeedDbFile(FaqPhoto::class, $config['DbPhoto'] . '.sql');
        SeedDbFile(FaqPhotoTranslation::class, $config['DbPhotoTrans'] . '.sql');

//        SeedDbFile(FaqCategory::class, 'faq_category.sql');
//        SeedDbFile(FaqCategoryTranslation::class, 'faq_category_translations.sql');
//        SeedDbFile(FaqTags::class, 'faq_tags.sql');
//        SeedDbFile(FaqTagsTranslation::class, 'faq_tags_translations.sql');
//        SeedDbFile(Faq::class, 'faq_post.sql');
//        SeedDbFile(FaqTranslation::class, 'faq_post_translations.sql');
//        SeedDbFile(FaqPivot::class, 'faq_category_t_pivot.sql');
//        SeedDbFile(FaqTagsPivot::class, 'faq_tags_t_pivot.sql');
//        SeedDbFile(FaqPhoto::class, 'faq_photo.sql');
//        SeedDbFile(FaqPhotoTranslation::class, 'faq_photo_translations.sql');
    }

}
