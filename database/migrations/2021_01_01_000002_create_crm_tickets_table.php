<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('crm_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->integer('state')->nullable();
            $table->integer('follow_state')->nullable();
            $table->dateTime('follow_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sours_id')->nullable();
            $table->integer('ads_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('notes_err')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('crm_ticket_des', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id');

            $table->longText("des")->nullable();
            $table->timestamps();
            $table->foreign('ticket_id')->references('id')->on('crm_ticket')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('crm_ticket_des');
        Schema::dropIfExists('crm_ticket');
    }

};
