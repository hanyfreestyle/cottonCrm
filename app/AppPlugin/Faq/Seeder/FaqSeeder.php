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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqSeeder extends Seeder {

    public function run(): void {
        $Config = FaqConfigTraits::DbConfig();


        if ($Config['TableCategory']) {
            FaqCategory::unguard();
            $tablePath = public_path('db/faq_category.sql');
            DB::unprepared(file_get_contents($tablePath));

            FaqCategoryTranslation::unguard();
            $tablePath = public_path('db/faq_category_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if ($Config['TableTags']) {
            FaqTags::unguard();
            $tablePath = public_path('db/faq_tags.sql');
            DB::unprepared(file_get_contents($tablePath));

            FaqTagsTranslation::unguard();
            $tablePath = public_path('db/faq_tags_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        Faq::unguard();
        $tablePath = public_path('db/faq_faqs.sql');
        DB::unprepared(file_get_contents($tablePath));

        FaqTranslation::unguard();
        $tablePath = public_path('db/faq_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

        if ($Config['TableCategory']) {
            FaqPivot::unguard();
            $tablePath = public_path('db/faq_category_faq.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if($Config['TableTags']){
            FaqTagsPivot::unguard();
            $tablePath = public_path('db/faq_tags_post.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if ($Config['TableMorePhotos']) {
            FaqPhoto::unguard();
            $tablePath = public_path('db/faq_photo.sql');
            DB::unprepared(file_get_contents($tablePath));

            FaqPhotoTranslation::unguard();
            $tablePath = public_path('db/faq_photo_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }


    }
}
