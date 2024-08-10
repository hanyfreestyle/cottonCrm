<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('config_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('web_url')->nullable();
            $table->integer('web_status')->nullable()->default('1');
            $table->integer('switch_lang')->nullable()->default('1');
            $table->integer('users_login')->nullable();


            $table->string('phone_num')->nullable();
            $table->string('whatsapp_num')->nullable();
            $table->string('phone_call')->nullable();
            $table->string('whatsapp_send')->nullable();
            $table->string('email')->nullable();
            $table->string('def_url')->nullable();

            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('google_api')->nullable();

            $table->integer('telegram_send')->nullable();
            $table->text('telegram_key')->nullable();
            $table->text('telegram_phone')->nullable();
            $table->text('telegram_group')->nullable();

            $table->integer('page_about')->nullable()->default('1');
            $table->integer('page_warranty')->nullable()->default('1');
            $table->integer('page_shipping')->nullable()->default('1');
            $table->integer('pro_sale_lable')->nullable()->default('1');
            $table->integer('pro_quick_view')->nullable()->default('1');
            $table->integer('pro_quick_shop')->nullable()->default('1');
            $table->integer('pro_warranty_tab')->nullable()->default('1');
            $table->integer('pro_shipping_tab')->nullable()->default('1');
            $table->integer('pro_social_share')->nullable()->default('1');
            $table->integer('serach')->nullable()->default('1');
            $table->integer('serach_type')->nullable()->default('1');
            $table->integer('wish_list')->nullable()->default('1');

            $table->string('schema_type')->nullable();
            $table->string('schema_lat')->nullable();
            $table->string('schema_long')->nullable();
            $table->string('schema_postal_code')->nullable();
            $table->string('schema_country')->nullable();

        });


        Schema::create('config_setting_translations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('setting_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('closed_mass')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('whatsapp_des')->nullable();
            $table->text('schema_address')->nullable();
            $table->text('schema_city')->nullable();
            $table->unique(['setting_id', 'locale']);
            $table->foreign('setting_id')->references('id')->on('config_setting')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('config_setting_translations');
        Schema::dropIfExists('config_setting');
    }
};
