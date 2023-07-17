<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phases', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('step_id')->comment('شناسه مرحله');
            $table->unsignedBigInteger('age_id')->comment('شناسه بازه‌سنی');
            $table->boolean('gender')->comment('جنسیت');
            $table->enum('nationality', ['iran', 'other'])->default('iran')->comment('ملیت');
            $table->timestamps();

            $table->foreign('step_id')->references('id')->on('steps')->cascadeOnDelete();
            $table->foreign('age_id')->references('id')->on('age_ranges')->cascadeOnDelete();

            $table->comment('فازها');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
    }
};
