<?php

namespace Database\Seeders;

use App\AppPlugin\Models\Faq\Seeder\FaqSeeder;
use App\AppPlugin\Models\BlogPost\Seeder\BlogCategorySeeder;
use App\AppPlugin\Models\Pages\Seeder\PageSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ModelSeeder extends Seeder {

    public function run(): void {

        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $this->call(BlogCategorySeeder::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
            $this->call(FaqSeeder::class);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
            $this->call(PageSeeder::class);
        }

    }
}
