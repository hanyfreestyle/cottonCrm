<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('crm_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->integer('open_type')->default(1);
            $table->integer('state')->nullable();
            $table->integer('follow_state')->nullable();
            $table->date('follow_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sours_id')->nullable();
            $table->integer('ads_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('notes_err')->nullable();


            $table->date('close_date')->nullable();
            $table->integer('review_state')->nullable()->default(0);

            $table->integer('old_id')->nullable();
            $table->integer('old_customer_id')->nullable();
            $table->integer('old_sours_id')->nullable();
            $table->integer('old_ads_id')->nullable();
            $table->integer('old_device_id')->nullable();
            $table->integer('old_brand_id')->nullable();

            $table->decimal('done_price')->nullable();
            $table->decimal('done_price_prepaid')->nullable();
            $table->longText("done_notes")->nullable();
            $table->longText("reject_notes")->nullable();
            $table->longText("cancellation_notes")->nullable();

            $table->timestamps();
        });

        Schema::create('crm_ticket_des', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('follow_date')->nullable();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('follow_state');
            $table->longText("des")->nullable();
            $table->foreign('ticket_id')->references('id')->on('crm_ticket')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('crm_ticket_cash', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('follow_state');

            $table->date('created_at')->nullable();
            $table->time('created_at_time')->nullable();
            $table->date('confirm_date')->nullable();
            $table->time('confirm_date_time')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('confirm_user_id')->nullable();

            $table->integer('amount_type');
            $table->integer('pay_type');
            $table->decimal('amount');
            $table->decimal('amount_paid')->nullable();

//            $table->longText("des")->nullable();

            $table->foreign('ticket_id')->references('id')->on('crm_ticket')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('crm_customers')->onDelete('restrict');
        });


    }

    public function down(): void {
        Schema::dropIfExists('crm_ticket_cash');
        Schema::dropIfExists('crm_ticket_des');
        Schema::dropIfExists('crm_ticket');
    }

};
