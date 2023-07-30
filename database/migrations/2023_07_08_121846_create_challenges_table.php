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
            $table->unsignedBigInteger('competition_id')->comment('شناسه مسابقه');
            $table->unsignedBigInteger('challenge_id')->comment('شناسه چالش');
            $table->enum('gender', [-1, 0, 1])->comment('جنسیت همه/خانم/آقا');
            $table->enum('nationality', [-1, 0, 1])->comment('جنسیت همه/خانم/آقا');
            $table->dateTime('start_time')->comment('زمان شروع');
            $table->dateTime('finish_time')->comment('زمان پایان');
            $table->dateTime('result_start_time')->comment('زمان شروع ثبت نام');
            $table->dateTime('result_finish_time')->comment('زمان پایان ثبت نام');
            $table->timestamps();

            $table->foreign('competition_id')->references('id')->on('competitions')->cascadeOnDelete();
            $table->foreign('field_id')->references('id')->on('fields')->cascadeOnDelete();

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
