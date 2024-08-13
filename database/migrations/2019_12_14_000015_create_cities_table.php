<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('data_city', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("old_id")->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->boolean("is_active")->default(true);
            $table->boolean("postion")->default(0);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();

            $table->integer("rate")->nullable();
            $table->integer("discount")->nullable();

            if(File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
                $table->foreign('country_id')->references('id')->on('data_countries')->onDelete('cascade');
            }

        });

        Schema::create('data_city_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('city_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('g_title')->nullable();
            $table->string('g_des')->nullable();
            $table->string('slug')->nullable();
            $table->unique(['city_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('city_id')->references('id')->on('data_city')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('data_city_translations');
        Schema::dropIfExists('data_city');
    }
};
