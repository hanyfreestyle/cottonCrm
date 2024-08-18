<?php

namespace App\AppPlugin\Models\Pages\Seeder;


use App\AppPlugin\Models\Pages\Models\Page;
use App\AppPlugin\Models\Pages\Models\PageCategory;
use App\AppPlugin\Models\Pages\Models\PageCategoryTranslation;
use App\AppPlugin\Models\Pages\Models\PagePhoto;
use App\AppPlugin\Models\Pages\Models\PagePhotoTranslation;
use App\AppPlugin\Models\Pages\Models\PagePivot;
use App\AppPlugin\Models\Pages\Models\PageTags;
use App\AppPlugin\Models\Pages\Models\PageTagsPivot;
use App\AppPlugin\Models\Pages\Models\PageTagsTranslation;
use App\AppPlugin\Models\Pages\Models\PageTranslation;
use App\AppPlugin\Models\Pages\Traits\PageConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PageSeeder extends Seeder {

    public function run(): void {
        $config = PageConfigTraits::DbConfig();

        SeedDbFile(PageCategory::class, $config['DbCategory'] . ".sql");
        SeedDbFile(PageCategoryTranslation::class, $config['DbCategoryTrans'] . ".sql");
        SeedDbFile(PageTags::class, $config['DbTags'] . '.sql');
        SeedDbFile(PageTagsTranslation::class, $config['DbTagsTrans'] . '.sql');
        SeedDbFile(Page::class, $config['DbPost'] . '.sql');
        SeedDbFile(PageTranslation::class, $config['DbPostTrans'] . '.sql');
        SeedDbFile(PagePivot::class, $config['DbCategoryPivot'] . '.sql');
        SeedDbFile(PageTagsPivot::class, $config['DbTagsPivot'] . '.sql');
        SeedDbFile(PagePhoto::class, $config['DbPhoto'] . '.sql');
        SeedDbFile(PagePhotoTranslation::class, $config['DbPhotoTrans'] . '.sql');

//        if ($Config['TableCategory']) {
//            PageCategory::unguard();
//            $tablePath = public_path('db/page_categories.sql');
//            DB::unprepared(file_get_contents($tablePath));
//
//            PageCategoryTranslation::unguard();
//            $tablePath = public_path('db/page_category_lang.sql');
//            DB::unprepared(file_get_contents($tablePath));
//        }
//
//        if ($Config['TableTags']) {
//            PageTags::unguard();
//            $tablePath = public_path('db/page_tags.sql');
//            DB::unprepared(file_get_contents($tablePath));
//
//            PageTagsTranslation::unguard();
//            $tablePath = public_path('db/page_tags_lang.sql');
//            DB::unprepared(file_get_contents($tablePath));
//        }
//
//        Page::unguard();
//        $tablePath = public_path('db/page_pages.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        PageTranslation::unguard();
//        $tablePath = public_path('db/page_translations.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        if ($Config['TableCategory']) {
//            PagePivot::unguard();
//            $tablePath = public_path('db/pagecategory_page.sql');
//            DB::unprepared(file_get_contents($tablePath));
//        }
//
//        if($Config['TableTags']){
//            PageTagsPivot::unguard();
//            $tablePath = public_path('db/page_tags_post.sql');
//            DB::unprepared(file_get_contents($tablePath));
//        }
//
//        if ($Config['TableMorePhotos']) {
//
//            PagePhoto::unguard();
//            $tablePath = public_path('db/page_photos.sql');
//            DB::unprepared(file_get_contents($tablePath));
//
//            PagePhotoTranslation::unguard();
//            $tablePath = public_path('db/page_photo_lang.sql');
//            DB::unprepared(file_get_contents($tablePath));
//        }


    }
}
