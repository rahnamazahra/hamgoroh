<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('field_id')->comment('شناسه رشته');
            $table->unsignedBigInteger('age_id')->comment('شناسه بازه‌سنی');
            $table->enum('gender', [-1, 0, 1])->comment('جنسیت همه/خانم/آقا');
            $table->enum('nationality', [-1, 0, 1])->comment('ملیت همه/ایرانی/خارجی');
            $table->dateTime('start_time')->comment('زمان شروع');
            $table->dateTime('finish_time')->comment('زمان پایان');
            $table->dateTime('result_start_time')->comment('زمان شروع ثبت نام');
            $table->dateTime('result_finish_time')->comment('زمان پایان ثبت نام');
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->cascadeOnUpdate();
            $table->foreign('age_id')->references('id')->on('age_ranges')->cascadeOnDelete();

            $table->comment('چالش‌ها');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
