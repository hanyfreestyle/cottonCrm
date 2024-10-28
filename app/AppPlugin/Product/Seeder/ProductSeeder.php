<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryPivot;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductTranslation;

use App\AppPlugin\Product\Models\LandingPage;
use App\AppPlugin\Product\Models\LandingPageTranslation;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTagsPivot;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    use ProductConfigTraits;

    public function run(): void {

        $config = ProductConfigTraits::DbConfig();
        SeedDbFile(Category::class, $config['DbCategory'] . ".sql");
        SeedDbFile(CategoryTranslation::class, $config['DbCategoryTrans'] . ".sql");

        SeedDbFile(Product::class, $config['DbPost'] . ".sql");
        SeedDbFile(ProductTranslation::class, $config['DbPostTrans'] . ".sql");


        SeedDbFile(CategoryPivot::class, $config['DbCategoryPivot'] . ".sql");




//        LandingPage::unguard();
//        $tablePath = public_path('db/pro_landing_page.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        LandingPageTranslation::unguard();
//        $tablePath = public_path('db/pro_landing_page_translations.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//
//        ProductPhoto::unguard();
//        $tablePath = public_path('db/pro_product_photos.sql');
//        DB::unprepared(file_get_contents($tablePath));
//

//        ProductAttribute::unguard();
//        $tablePath = public_path('db/pro_product_attribute.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        ProductTagsPivot::unguard();
//        $tablePath = public_path('db/pro_tags_product.sql');
//        DB::unprepared(file_get_contents($tablePath));

    }

}
