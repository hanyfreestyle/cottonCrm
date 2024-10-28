<?php

namespace App\AppPlugin\Product\Seeder;

use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeTranslation;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\BrandTranslation;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\AppPlugin\Product\Models\ProductTags;
use App\AppPlugin\Product\Models\ProductTagsTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductCategoriesSeeder extends Seeder {

    public function run(): void {


//        Brand::unguard();
//        $tablePath = public_path('db/pro_brands.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        BrandTranslation::unguard();
//        $tablePath = public_path('db/pro_brand_translations.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        Attribute::unguard();
//        $tablePath = public_path('db/pro_attributes.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        AttributeTranslation::unguard();
//        $tablePath = public_path('db/pro_attribute_translations.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        AttributeValue::unguard();
//        $tablePath = public_path('db/pro_attribute_values.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        AttributeValue::unguard();
//        $tablePath = public_path('db/pro_attribute_value_translations.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        ProductTags::unguard();
//        $tablePath = public_path('db/pro_tags.sql');
//        DB::unprepared(file_get_contents($tablePath));
//
//        ProductTagsTranslation::unguard();
//        $tablePath = public_path('db/pro_tags_translations.sql');
//        DB::unprepared(file_get_contents($tablePath));

    }

}
