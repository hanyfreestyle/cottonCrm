<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('book_periodicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('release_id')->nullable();
            $table->integer('lang_id')->nullable();
            $table->text('des')->nullable();
            $table->integer('update')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('book_periodicals_release', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('periodicals_id');
            $table->integer('year')->nullable();
            $table->integer('number')->nullable();
            $table->foreign('periodicals_id')->references('id')->on('book_periodicals')->onDelete('cascade');

        });

    }

    public function down(): void {
        Schema::dropIfExists('book_periodicals_release');
        Schema::dropIfExists('book_periodicals');
    }

};
