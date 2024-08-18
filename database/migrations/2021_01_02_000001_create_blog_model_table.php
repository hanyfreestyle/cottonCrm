<?php

use App\Helpers\BaseMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\AppPlugin\Models\BlogPost\Traits\BlogConfigTraits;

return new class extends Migration {

    public function up(): void {

        $config = BlogConfigTraits::DbConfig();
        BaseMigration::createPostTable($config['DbPost'], $config['DbPostTrans'], $config['DbPostForeignId']);
        BaseMigration::createCategoryTable($config['DbCategory'], $config['DbCategoryTrans'], $config['DbCategoryPivot'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createMorePhotoTable($config['DbPhoto'], $config['DbPhotoTrans'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createTagsTable($config['DbTags'], $config['DbTagsTrans'], $config['DbTagsPivot'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createPostReviewTable($config['DbPostReview'], $config['DbPost']);
    }

    public function down(): void {
        $config = BlogConfigTraits::DbConfig();
        Schema::dropIfExists($config['DbPostReview']);
        Schema::dropIfExists($config['DbTagsPivot']);
        Schema::dropIfExists($config['DbTagsTrans']);
        Schema::dropIfExists($config['DbTags']);
        Schema::dropIfExists($config['DbPhotoTrans']);
        Schema::dropIfExists($config['DbPhoto']);
        Schema::dropIfExists($config['DbCategoryPivot']);
        Schema::dropIfExists($config['DbCategoryTrans']);
        Schema::dropIfExists($config['DbCategory']);
        Schema::dropIfExists($config['DbPostTrans']);
        Schema::dropIfExists($config['DbPost']);
    }

};
