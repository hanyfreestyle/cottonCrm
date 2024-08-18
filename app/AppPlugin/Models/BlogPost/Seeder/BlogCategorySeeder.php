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
