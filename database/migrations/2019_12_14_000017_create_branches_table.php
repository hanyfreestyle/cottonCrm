<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('whatsapp')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('direction')->nullable();

            $table->integer('is_active')->default(1);
            $table->integer('postion')->default(0);
            $table->softDeletes();
        });

        Schema::create('config_branch_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('branch_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('work_hours')->nullable();

            $table->unique(['branch_id', 'locale']);
            $table->foreign('branch_id')->references('id')->on('config_branches')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('config_branch_translations');
        Schema::dropIfExists('config_branches');
    }
};
