<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->default(1);
            $table->integer('old_id')->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
        });

        Schema::create('pro_attribute_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attribute_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->unique(['attribute_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });

        Schema::create('pro_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attribute_id')->unsigned();
            $table->integer('old_id')->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });

        Schema::create('pro_attribute_value_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('value_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->integer('count')->nullable();
            $table->unique(['value_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('value_id')->references('id')->on('pro_attribute_values')->onDelete('cascade');
        });

        Schema::create('pro_product_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('attribute_id')->unsigned();
            $table->json('values')->nullable();
            $table->foreign('product_id')->references('id')->on('pro_product')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('pro_product_attribute');
        Schema::dropIfExists('pro_attribute_value_translations');
        Schema::dropIfExists('pro_attribute_values');
        Schema::dropIfExists('pro_attribute_translations');
        Schema::dropIfExists('pro_attributes');
    }
};
