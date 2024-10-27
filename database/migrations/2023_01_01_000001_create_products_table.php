<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pro_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('variants_slug_id')->nullable();

            $table->integer('brand_id')->nullable()->default(null);
            $table->integer('def_cat')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);

            $table->float('price')->nullable()->default(null);
            $table->float('regular_price')->nullable()->default(null);

            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();


            $table->boolean("on_stock")->default(true);
            $table->boolean("is_active")->default(true);
            $table->boolean("is_archived")->default(false);
            $table->integer('featured')->default(0);
            $table->integer('sales_count')->default(1);

            $table->timestamps();
            $table->softDeletes();
            $table->integer('attributes_count')->nullable();
            $table->integer('parents_count')->nullable();
            $table->foreign('parent_id')->references('id')->on('pro_products')->onDelete('cascade');
        });

        Schema::create('pro_product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->longText('short_des')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['product_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });


        Schema::create('pro_landing_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("is_active")->nullable()->default(true);
            $table->boolean("is_soft")->nullable()->default(true);
            $table->integer('brand_id')->nullable();
            $table->json('product_id')->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->timestamps();
        });

        Schema::create('pro_landing_page_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();

            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->longText('desup')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();

            $table->unique(['page_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('page_id')->references('id')->on('pro_landing_page')->onDelete('cascade');
        });


    }


    public function down(): void {
        Schema::dropIfExists('pro_landing_page_translations');
        Schema::dropIfExists('pro_landing_page');
        Schema::dropIfExists('pro_product_translations');
        Schema::dropIfExists('pro_products');
    }
};
