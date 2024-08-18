<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseMigration {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function createCategoryTable($DbCategory, $DbCategoryTrans, $DbCategoryPivot, $DbPost, $DbPostForeignId) {

        Schema::create("$DbCategory", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('deep')->default(0);
            $table->string("icon")->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        Schema::create("$DbCategoryTrans", function (Blueprint $table) use ($DbCategory) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->text('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['category_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('category_id')->references('id')->on("$DbCategory")->onDelete('cascade');
        });


        Schema::create("$DbCategoryPivot", function (Blueprint $table) use ($DbCategory, $DbPost, $DbPostForeignId) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger("$DbPostForeignId");
            $table->integer('position')->default(0);

            $table->foreign('category_id')->references('id')->on("$DbCategory")->onDelete('cascade');
            $table->foreign("$DbPostForeignId")->references('id')->on("$DbPost")->onDelete('cascade');
        });


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function createPostTable($DbPost, $DbPostTrans, $DbPostForeignId) {

        Schema::create("$DbPost", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->boolean("is_active")->nullable()->default(true);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->integer('url_type')->nullable()->default(0);
            $table->string('youtube')->nullable();
            $table->date('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create("$DbPostTrans", function (Blueprint $table) use ($DbPost, $DbPostForeignId) {
            $table->bigIncrements('id');
            $table->bigInteger("$DbPostForeignId")->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();

            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('youtube_title')->nullable();

            $table->unique([$DbPostForeignId, 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign("$DbPostForeignId")->references('id')->on("$DbPost")->onDelete('cascade');
        });

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function createMorePhotoTable($DbPhoto, $DbPhotoTrans, $DbPost, $DbPostForeignId) {

        Schema::create("$DbPhoto", function (Blueprint $table) use ($DbPost, $DbPostForeignId) {
            $table->bigIncrements('id');
            $table->bigInteger($DbPostForeignId)->unsigned();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->integer("position")->default(0);
            $table->integer("print_photo")->default(2);
            $table->integer("is_default")->default(0);
            $table->foreign($DbPostForeignId)->references('id')->on("$DbPost")->onDelete('cascade');
        });

        Schema::create("$DbPhotoTrans", function (Blueprint $table) use ($DbPhoto) {
            $table->bigIncrements('id');
            $table->bigInteger('photo_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('des')->nullable();
            $table->unique(['photo_id', 'locale']);
            $table->foreign('photo_id')->references('id')->on($DbPhoto)->onDelete('cascade');;
        });


    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function createTagsTable($DbTags, $DbTagsTrans, $DbTagsPivot, $DbPost, $DbPostForeignId) {

        Schema::create("$DbTags", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("is_active")->default(true);
        });

        Schema::create("$DbTagsTrans", function (Blueprint $table) use ($DbTags) {
            $table->bigIncrements('id');
            $table->bigInteger('tag_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->unique(['tag_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('tag_id')->references('id')->on("$DbTags")->onDelete('cascade');
        });

        Schema::create("$DbTagsPivot", function (Blueprint $table) use ($DbPost, $DbTags, $DbPostForeignId) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('tag_id');
            $table->unsignedBiginteger("$DbPostForeignId");

            $table->foreign('tag_id')->references('id')->on("$DbTags")->onDelete('cascade');
            $table->foreign("$DbPostForeignId")->references('id')->on("$DbPost")->onDelete('cascade');
        });
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function createPostReviewTable($DbPostReview, $DbPost) {
        Schema::create("$DbPostReview", function (Blueprint $table) use ($DbPost) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->dateTime('updated_at');
            $table->foreign('post_id')->references('id')->on("$DbPost")->onDelete('cascade');
        });
    }



}
