<?php

use App\AppPlugin\Models\Pages\Traits\PageConfigTraits;
use App\Helpers\BaseMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {


        $config = PageConfigTraits::DbConfig();

        BaseMigration::createPostTable($config['DbPost'], $config['DbPostTrans'], $config['DbPostForeignId']);
        BaseMigration::createCategoryTable($config['DbCategory'], $config['DbCategoryTrans'], $config['DbCategoryPivot'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createMorePhotoTable($config['DbPhoto'], $config['DbPhotoTrans'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createTagsTable($config['DbTags'], $config['DbTagsTrans'], $config['DbTagsPivot'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createPostReviewTable($config['DbPostReview'], $config['DbPost']);

//        Schema::create('page_categories', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBigInteger('parent_id')->nullable();
//            $table->integer('deep')->default(0);
//            $table->string("icon")->nullable();
//            $table->string("photo")->nullable();
//            $table->string("photo_thum_1")->nullable();
//            $table->boolean("is_active")->default(true);
//            $table->integer('position')->default(0);
//            $table->timestamps();
//        });
//
//        Schema::create('page_category_lang', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('category_id')->unsigned();
//            $table->string('locale')->index();
//            $table->string('slug')->nullable();
//            $table->string('name')->nullable();
//            $table->text('des')->nullable();
//            $table->string('g_title')->nullable();
//            $table->text('g_des')->nullable();
//
//
//            $table->unique(['category_id', 'locale']);
//            $table->unique(['locale', 'slug']);
//            $table->foreign('category_id')->references('id')->on('page_categories')->onDelete('cascade');
//        });
//
//        Schema::create('page_pages', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->integer('user_id')->nullable();
//            $table->boolean("is_active")->nullable()->default(true);
//            $table->string("photo")->nullable();
//            $table->string("photo_thum_1")->nullable();
//            $table->integer('url_type')->nullable()->default(0);
//            $table->string('youtube')->nullable();
//            $table->date('published_at')->nullable();
//            $table->softDeletes();
//            $table->timestamps();
//        });
//
//        Schema::create('page_translations', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('page_id')->unsigned();
//            $table->string('locale')->index();
//            $table->string('slug')->nullable();
//
//            $table->string('name')->nullable();
//            $table->longText('des')->nullable();
//            $table->string('g_title')->nullable();
//            $table->text('g_des')->nullable();
//            $table->string('youtube_title')->nullable();
//
//            $table->unique(['page_id', 'locale']);
//            $table->unique(['locale', 'slug']);
//            $table->foreign('page_id')->references('id')->on('page_pages')->onDelete('cascade');
//        });
//
//        if (IsConfig($Config, 'TableReview')) {
//
//        }
//        Schema::create('page_review', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('user_id')->unsigned();
//            $table->bigInteger('post_id')->unsigned();
//            $table->dateTime('updated_at');
//            $table->foreign('post_id')->references('id')->on('page_pages')->onDelete('cascade');
//        });
//
//
//        if (IsConfig($Config, 'TableCategory')) {
//
//        }
//        Schema::create('pagecategory_page', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBiginteger('category_id');
//            $table->unsignedBiginteger('page_id');
//            $table->integer('position')->default(0);
//
//            $table->foreign('category_id')->references('id')->on('page_categories')->onDelete('cascade');
//            $table->foreign('page_id')->references('id')->on('page_pages')->onDelete('cascade');
//        });
//
//        if (IsConfig($Config, 'TableMorePhotos')) {
//
//        }
//
//        Schema::create('page_photos', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('page_id')->unsigned();
//            $table->string("photo")->nullable();
//            $table->string("photo_thum_1")->nullable();
//            $table->string("photo_thum_2")->nullable();
//            $table->integer("position")->default(0);
//            $table->integer("print_photo")->default(2);
//            $table->integer("is_default")->default(0);
//            $table->foreign('page_id')->references('id')->on('page_pages')->onDelete('cascade');
//        });
//
//        Schema::create('page_photo_lang', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('photo_id')->unsigned();
//            $table->string('locale')->index();
//            $table->longText('des')->nullable();
//            $table->unique(['photo_id', 'locale']);
//            $table->foreign('photo_id')->references('id')->on('page_photos')->onDelete('cascade');;
//        });
//
//
//        if (IsConfig($Config, 'TableTags')) {
//
//
//        }
//
//        Schema::create('page_tags', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->boolean("is_active")->default(true);
//        });
//
//        Schema::create('page_tags_lang', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('tag_id')->unsigned();
//            $table->string('locale')->index();
//            $table->string('slug')->nullable();
//            $table->string('name')->nullable();
//            $table->unique(['tag_id', 'locale']);
//            $table->unique(['locale', 'slug']);
//            $table->foreign('tag_id')->references('id')->on('page_tags')->onDelete('cascade');
//        });
//
//        Schema::create('page_tags_post', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBiginteger('tag_id');
//            $table->unsignedBiginteger('post_id');
//
//            $table->foreign('tag_id')->references('id')->on('page_tags')->onDelete('cascade');
//            $table->foreign('post_id')->references('id')->on('page_pages')->onDelete('cascade');
//        });


    }

    public function down(): void {
        $config = PageConfigTraits::DbConfig();
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
