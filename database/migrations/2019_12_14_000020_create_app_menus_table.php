<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_app_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum("type", ['side', 'user', 'cart'])->nullable();
            $table->integer('postion')->default(0);
            $table->integer('is_active')->default(1);
            $table->softDeletes();
        });

        Schema::create('config_app_menu_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('menu_id')->unsigned();
            $table->string('locale')->index();

            $table->string('url')->nullable();
            $table->string('label')->nullable();
            $table->integer('icon')->nullable();
            $table->integer('title')->default(1);

            $table->unique(['menu_id', 'locale']);
            $table->foreign('menu_id')->references('id')->on('config_app_menus')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('config_app_menu_translations');
        Schema::dropIfExists('config_app_menus');
    }
};
