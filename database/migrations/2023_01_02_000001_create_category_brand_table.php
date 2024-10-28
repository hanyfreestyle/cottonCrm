<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('pro_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('old_id')->nullable();
            $table->integer('old_parent')->nullable();
            $table->integer('deep')->default(0);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("icon")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->integer('product_count')->default(0);
            $table->timestamps();
        });

        Schema::create('pro_category_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['category_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('category_id')->references('id')->on('pro_category')->onDelete('cascade');
        });

        Schema::create('pro_category_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger('product_id');
            $table->foreign('category_id')->references('id')->on('pro_category')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('pro_product')->onDelete('cascade');
        });


        Schema::create('pro_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('old_id')->nullable();
            $table->integer('deep')->default(0);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("icon")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->timestamps();
        });

        Schema::create('pro_brand_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['brand_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('brand_id')->references('id')->on('pro_brands')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('pro_brand_translations');
        Schema::dropIfExists('pro_brands');
        Schema::dropIfExists('pro_category_pivot');
        Schema::dropIfExists('pro_category_lang');
        Schema::dropIfExists('pro_category');
    }
};
