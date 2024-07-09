<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_data_import', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sub_id')->nullable();

            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("organization")->nullable();

            $table->string("phone")->nullable();
            $table->string("full_number")->nullable();
            $table->string("country_code")->nullable();
            $table->string("country")->nullable();

            $table->text("get_data")->nullable();
            $table->string("get_name")->nullable();
            $table->string("get_phone")->nullable();


            $table->integer('check_name')->nullable();
            $table->integer('check_num')->nullable();
            $table->integer('check_country')->nullable();
            $table->integer('num_count')->nullable();
            $table->timestamps();

            $table->foreign('sub_id')->references('id')->on('config_data_import')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('config_data_import');
    }

};
