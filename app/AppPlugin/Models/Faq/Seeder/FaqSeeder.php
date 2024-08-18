<?php

namespace App\AppPlugin\Models\Faq\Seeder;

use App\AppPlugin\Models\Faq\Models\Faq;
use App\AppPlugin\Models\Faq\Models\FaqCategory;
use App\AppPlugin\Models\Faq\Models\FaqCategoryTranslation;
use App\AppPlugin\Models\Faq\Models\FaqPhoto;
use App\AppPlugin\Models\Faq\Models\FaqPhotoTranslation;
use App\AppPlugin\Models\Faq\Models\FaqPivot;
use App\AppPlugin\Models\Faq\Models\FaqTags;
use App\AppPlugin\Models\Faq\Models\FaqTagsPivot;
use App\AppPlugin\Models\Faq\Models\FaqTagsTranslation;
use App\AppPlugin\Models\Faq\Models\FaqTranslation;
use App\AppPlugin\Models\Faq\Traits\FaqConfigTraits;
use Illuminate\Database\Seeder;


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

    }

}
