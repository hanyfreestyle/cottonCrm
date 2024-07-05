<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('old_id')->nullable();
            $table->string('cat_id');
            $table->boolean("is_active")->default(true);
        });


        Schema::create('config_data_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('data_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['data_id', 'locale']);
            $table->foreign('data_id')->references('id')->on('config_data')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('config_data_translations');
        Schema::dropIfExists('config_data');
    }
};
