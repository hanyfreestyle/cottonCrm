<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('data_area', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("old_id")->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->boolean("is_active")->default(true);
            $table->boolean("postion")->default(0);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();

            if (File::isFile(base_path('routes/AppPlugin/data/county.php'))) {
                $table->foreign('country_id')->references('id')->on('data_countries')->onDelete('cascade');
            }
            if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
                $table->foreign('city_id')->references('id')->on('data_city')->onDelete('cascade');
            }

        });

        Schema::create('data_area_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('area_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('g_title')->nullable();
            $table->string('g_des')->nullable();
            $table->string('slug')->nullable();
            $table->unique(['area_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('area_id')->references('id')->on('data_area')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('data_area_translations');
        Schema::dropIfExists('data_area');
    }
};
