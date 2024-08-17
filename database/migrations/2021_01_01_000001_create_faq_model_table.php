<?php

use App\AppPlugin\Faq\Traits\FaqConfigTraits;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        $Config = FaqConfigTraits::DbConfig();

        if ($Config['TableCategory']) {
            Schema::create('faq_category', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->integer('deep')->default(0);
                $table->string("icon")->nullable();
                $table->string("photo")->nullable();
                $table->string("photo_thum_1")->nullable();
                $table->boolean("is_active")->default(true);
                $table->integer('postion')->default(0);
                $table->timestamps();
            });

            Schema::create('faq_category_translations', function (Blueprint $table) {
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
                $table->foreign('category_id')->references('id')->on('faq_category')->onDelete('cascade');
            });
        }


        Schema::create('faq_faqs', function (Blueprint $table) {
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

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('faq_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();

            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('youtube_title')->nullable();

            $table->unique(['faq_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('faq_id')->references('id')->on('faq_faqs')->onDelete('cascade');
        });

        if ($Config['TableReview']) {
            Schema::create('faq_faqs_review', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned();
                $table->bigInteger('post_id')->unsigned();
                $table->dateTime('updated_at');
                $table->foreign('post_id')->references('id')->on('faq_faqs')->onDelete('cascade');
            });
        }

        if ($Config['TableCategory']) {
            Schema::create('faq_category_faq', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBiginteger('category_id');
                $table->unsignedBiginteger('faq_id');
                $table->integer('postion')->default(0);

                $table->foreign('category_id')->references('id')->on('faq_category')->onDelete('cascade');
                $table->foreign('faq_id')->references('id')->on('faq_faqs')->onDelete('cascade');
            });
        }

        if ($Config['TableMorePhotos']) {
            Schema::create('faq_photo', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('faq_id')->unsigned();
                $table->string("photo")->nullable();
                $table->string("photo_thum_1")->nullable();
                $table->string("photo_thum_2")->nullable();
                $table->integer("position")->default(0);
                $table->integer("print_photo")->default(2);
                $table->integer("is_default")->default(0);
                $table->foreign('faq_id')->references('id')->on('faq_faqs')->onDelete('cascade');
            });

            Schema::create('faq_photo_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('photo_id')->unsigned();
                $table->string('locale')->index();
                $table->longText('des')->nullable();
                $table->unique(['photo_id', 'locale']);
                $table->foreign('photo_id')->references('id')->on('faq_photo')->onDelete('cascade');;
            });
        }

        if ($Config['TableTags']) {

            Schema::create('faq_tags', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->boolean("is_active")->default(true);
            });

            Schema::create('faq_tags_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('tag_id')->unsigned();
                $table->string('locale')->index();
                $table->string('slug')->nullable();
                $table->string('name')->nullable();
                $table->unique(['tag_id', 'locale']);
                $table->unique(['locale', 'slug']);
                $table->foreign('tag_id')->references('id')->on('faq_tags')->onDelete('cascade');
            });

            Schema::create('faq_tags_post', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBiginteger('tag_id');
                $table->unsignedBiginteger('post_id');

                $table->foreign('tag_id')->references('id')->on('faq_tags')->onDelete('cascade');
                $table->foreign('post_id')->references('id')->on('faq_faqs')->onDelete('cascade');
            });
        }

    }

    public function down(): void {
        Schema::dropIfExists('faq_tags_post');
        Schema::dropIfExists('faq_tags_translations');
        Schema::dropIfExists('faq_tags');
        Schema::dropIfExists('faq_photo_translations');
        Schema::dropIfExists('faq_photo');
        Schema::dropIfExists('faq_category_faq');
        Schema::dropIfExists('faq_faqs_review');
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faq_faqs');
        Schema::dropIfExists('faq_category_translations');
        Schema::dropIfExists('faq_category');
    }
};
