<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('leads_contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('full_number')->nullable();
            $table->string('country')->nullable();
            $table->string('subject')->nullable();
            $table->integer('request_type')->default(1);
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('leads_contact_us');
    }

};
