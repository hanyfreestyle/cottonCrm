<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\CategoryProduct;
use App\AppPlugin\Product\Models\LandingPage;
use App\AppPlugin\Product\Models\LandingPageTranslation;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTagsPivot;
use App\AppPlugin\Product\Models\ProductTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {

    public function run(): void {
        Product::unguard();
        $tablePath = public_path('db/pro_products.sql');
        DB::unprepared(file_get_contents($tablePath));

        ProductTranslation::unguard();
        $tablePath = public_path('db/pro_product_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

        LandingPage::unguard();
        $tablePath = public_path('db/pro_landing_page.sql');
        DB::unprepared(file_get_contents($tablePath));

        LandingPageTranslation::unguard();
        $tablePath = public_path('db/pro_landing_page_translations.sql');
        DB::unprepared(file_get_contents($tablePath));


        ProductPhoto::unguard();
        $tablePath = public_path('db/pro_product_photos.sql');
        DB::unprepared(file_get_contents($tablePath));

        CategoryProduct::unguard();
        $tablePath = public_path('db/pro_category_product.sql');
        DB::unprepared(file_get_contents($tablePath));

        ProductAttribute::unguard();
        $tablePath = public_path('db/pro_product_attribute.sql');
        DB::unprepared(file_get_contents($tablePath));

        ProductTagsPivot::unguard();
        $tablePath = public_path('db/pro_tags_product.sql');
        DB::unprepared(file_get_contents($tablePath));

    }

}
