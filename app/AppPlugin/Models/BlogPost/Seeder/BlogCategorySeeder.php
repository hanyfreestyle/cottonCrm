<?php

namespace App\AppPlugin\Models\BlogPost\Seeder;

use App\AppPlugin\Models\BlogPost\Models\Blog;
use App\AppPlugin\Models\BlogPost\Models\BlogCategory;
use App\AppPlugin\Models\BlogPost\Models\BlogCategoryTranslation;
use App\AppPlugin\Models\BlogPost\Models\BlogPhoto;
use App\AppPlugin\Models\BlogPost\Models\BlogPhotoTranslation;
use App\AppPlugin\Models\BlogPost\Models\BlogPivot;
use App\AppPlugin\Models\BlogPost\Models\BlogTags;
use App\AppPlugin\Models\BlogPost\Models\BlogTagsPivot;
use App\AppPlugin\Models\BlogPost\Models\BlogTagsTranslation;
use App\AppPlugin\Models\BlogPost\Models\BlogTranslation;
use App\AppPlugin\Models\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder {

    public function run(): void {
        $config = BlogConfigTraits::DbConfig();
        SeedDbFile(BlogCategory::class, $config['DbCategory'] . ".sql");
        SeedDbFile(BlogCategoryTranslation::class, $config['DbCategoryTrans'] . ".sql");
        SeedDbFile(BlogTags::class, $config['DbTags'] . '.sql');
        SeedDbFile(BlogTagsTranslation::class, $config['DbTagsTrans'] . '.sql');
        SeedDbFile(Blog::class, $config['DbPost'] . '.sql');
        SeedDbFile(BlogTranslation::class, $config['DbPostTrans'] . '.sql');
        SeedDbFile(BlogPivot::class, $config['DbCategoryPivot'] . '.sql');
        SeedDbFile(BlogTagsPivot::class, $config['DbTagsPivot'] . '.sql');
        SeedDbFile(BlogPhoto::class, $config['DbPhoto'] . '.sql');
        SeedDbFile(BlogPhotoTranslation::class, $config['DbPhotoTrans'] . '.sql');

    }
}
