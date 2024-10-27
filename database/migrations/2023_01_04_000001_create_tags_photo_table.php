<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("is_active")->default(true);
            $table->integer('count')->default(0);
        });

        Schema::create('pro_tags_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tag_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->unique(['tag_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('tag_id')->references('id')->on('pro_tags')->onDelete('cascade');
        });

        Schema::create('pro_tags_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('tag_id');
            $table->unsignedBiginteger('product_id');
            $table->foreign('tag_id')->references('id')->on('pro_tags')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });

        Schema::create('pro_product_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();

            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->string("file_extension")->nullable();
            $table->integer("file_size")->nullable();
            $table->integer("file_h")->nullable();
            $table->integer("file_w")->nullable();
            $table->integer("position")->default(0);
            $table->integer("is_default")->default(0);

            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('pro_product_photos');
        Schema::dropIfExists('pro_tags_product');
        Schema::dropIfExists('pro_tags_translations');
        Schema::dropIfExists('pro_tags');
    }
};
