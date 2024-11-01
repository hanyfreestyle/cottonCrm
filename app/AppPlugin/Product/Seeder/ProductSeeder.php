<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeTranslation;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\BrandTranslation;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryPivot;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductTags;
use App\AppPlugin\Product\Models\ProductTagsTranslation;
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

        SeedDbFile(Product::class, $config['DbPost'] . ".sql");
        SeedDbFile(ProductTranslation::class, $config['DbPostTrans'] . ".sql");

        SeedDbFile(Brand::class, $config['DbBrand'] . ".sql");
        SeedDbFile(BrandTranslation::class, $config['DbBrandTrans'] . ".sql");

        SeedDbFile(Category::class, $config['DbCategory'] . ".sql");
        SeedDbFile(CategoryTranslation::class, $config['DbCategoryTrans'] . ".sql");
        SeedDbFile(CategoryPivot::class, $config['DbCategoryPivot'] . ".sql");

        SeedDbFile(ProductTags::class, $config['DbTags'] . ".sql");
        SeedDbFile(ProductTagsTranslation::class, $config['DbTagsTrans'] . ".sql");
        SeedDbFile(ProductTagsPivot::class, $config['DbTagsPivot'] . ".sql");

        SeedDbFile(LandingPage::class, $config['DbLandingPage'] . ".sql");
        SeedDbFile(LandingPageTranslation::class, $config['DbLandingPageTrans'] . ".sql");

        SeedDbFile(Attribute::class, "pro_attribute.sql");
        SeedDbFile(AttributeTranslation::class, "pro_attribute_lang.sql");
        SeedDbFile(AttributeValue::class, "pro_attribute_value.sql");
        SeedDbFile(AttributeValue::class, "pro_attribute_value_lang.sql");


//        ProductPhoto::unguard();
//        $tablePath = public_path('db/pro_product_photos.sql');
//        DB::unprepared(file_get_contents($tablePath));


//        ProductAttribute::unguard();
//        $tablePath = public_path('db/pro_product_attribute.sql');
//        DB::unprepared(file_get_contents($tablePath));
//


    }

}
