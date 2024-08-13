<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('data_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('iso2', 2)->unique()->nullable();
            $table->string('iso3', 3)->nullable();
            $table->string('fips', 3)->nullable();
            $table->string('iso_numeric', 3)->nullable();
            $table->string('photo', 150)->nullable();
            $table->string('photo_thum_1', 150)->nullable();
            $table->string('photo_thum_2', 150)->nullable();
            $table->integer('phone')->nullable();
            $table->string('symbol', 10)->nullable();
            $table->string('currency_code', 3)->nullable();
            $table->string('continent_code', 2)->nullable();
            $table->string('language_codes')->nullable();
            $table->string('top_level_domain', 5)->nullable();
            $table->string('time_zone')->nullable();
            $table->string('area_km')->nullable();
            $table->integer('is_active')->default(1);
            $table->softDeletes();
        });

        Schema::create('data_country_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('g_title')->nullable();
            $table->string('g_des')->nullable();
            $table->string('slug')->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('continent')->nullable();
            $table->string('nationality')->nullable();

            $table->unique(['country_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('country_id')->references('id')->on('data_countries')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('data_country_translations');
        Schema::dropIfExists('data_countries');
    }

};
