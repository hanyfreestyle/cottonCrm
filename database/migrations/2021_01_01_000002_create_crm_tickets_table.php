<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('crm_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');

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
