<?php
namespace App\AppPlugin\BlogPost\Seeder;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogCategoryTranslation;
use App\AppPlugin\BlogPost\Models\BlogPhoto;
use App\AppPlugin\BlogPost\Models\BlogPhotoTranslation;
use App\AppPlugin\BlogPost\Models\BlogPivot;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\BlogPost\Models\BlogTagsPivot;
use App\AppPlugin\BlogPost\Models\BlogTagsTranslation;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BlogCategorySeeder extends Seeder {

    public function run(): void {

        $Config = BlogConfigTraits::DbConfig();

        if($Config['TableCategory']){
            BlogCategory::unguard();
            $tablePath = public_path('db/blog_categories.sql');
            DB::unprepared(file_get_contents($tablePath));

            BlogCategoryTranslation::unguard();
            $tablePath = public_path('db/blog_category_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if($Config['TableTags']){
            BlogTags::unguard();
            $tablePath = public_path('db/blog_tags.sql');
            DB::unprepared(file_get_contents($tablePath));

            BlogTagsTranslation::unguard();
            $tablePath = public_path('db/blog_tags_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        Blog::unguard();
        $tablePath = public_path('db/blog_post.sql');
        DB::unprepared(file_get_contents($tablePath));

        BlogTranslation::unguard();
        $tablePath = public_path('db/blog_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

        if($Config['TableCategory']){
            BlogPivot::unguard();
            $tablePath = public_path('db/blogcategory_blog.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if($Config['TableTags']){
            BlogTagsPivot::unguard();
            $tablePath = public_path('db/blog_tags_post.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

        if($Config['TableMorePhotos']){
            BlogPhoto::unguard();
            $tablePath = public_path('db/blog_photos.sql');
            DB::unprepared(file_get_contents($tablePath));

            BlogPhotoTranslation::unguard();
            $tablePath = public_path('db/blog_photo_translations.sql');
            DB::unprepared(file_get_contents($tablePath));
        }

    }
}
