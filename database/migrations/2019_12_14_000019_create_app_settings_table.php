<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('config_app_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default('1');

            $table->string('baseUrl')->nullable();
            $table->string('mobilePrefix')->nullable();
            $table->string('prefix')->nullable();

            $table->string('logo')->nullable();
            $table->string('SideLogo')->nullable();


            $table->bigInteger('ColorDark')->nullable();
            $table->bigInteger('ColorLight')->nullable();
            $table->bigInteger('AppBarIconColor')->nullable();
            $table->bigInteger('BackGroundColor')->nullable();
            $table->bigInteger('SplashColor')->nullable();
            $table->bigInteger('PreloadingColor')->nullable();
            $table->bigInteger('StatueBArColor')->nullable();
            $table->bigInteger('AppBarColor')->nullable();
            $table->bigInteger('AppBarColorText')->nullable();
            $table->bigInteger('sideMenuText')->nullable();
            $table->bigInteger('sideMenuColor')->nullable();

            $table->string('mainScreenScale')->nullable();
            $table->string('sideMenuAngle')->nullable();
            $table->string('sideMenuStyle')->nullable();
            $table->string('AppTheme')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();


            $table->string('whatsAppNumber')->nullable();
            $table->string('whatsAppKey')->nullable();

            $table->string('telegram_key')->nullable();
            $table->string('telegram_group')->nullable();
            $table->string('telegram_phone')->nullable();

            $table->timestamps();
        });

        Schema::create('config_app_setting_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('setting_id')->unsigned();
            $table->string('locale')->index();

            $table->string('AppName')->nullable();
            $table->string('whatsAppMessage')->nullable();

            $table->unique(['setting_id', 'locale']);
            $table->foreign('setting_id')->references('id')->on('config_app_settings')->onDelete('cascade');

        });
    }

    public function down(): void {
        Schema::dropIfExists('config_app_setting_translations');
        Schema::dropIfExists('config_app_settings');
    }
};
