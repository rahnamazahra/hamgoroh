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
        Schema::create('results', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('participant_id')->comment('شناسه شرکت کنندگان');
            $table->unsignedBigInteger('examiner_id')->comment('شناسه امتحان دهندگان');
            $table->unsignedBigInteger('evaluation_id')->comment('شناسه ارزیابی');
            $table->unsignedBigInteger('referee_id')->comment('شناسه داور');
            $table->unsignedBigInteger('step_id')->comment('شناسه مرحله');
            $table->float('score')->comment('نمره');
            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('examiner_id')->references('id')->on('examiners')->cascadeOnDelete();
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->cascadeOnDelete();
            $table->foreign('referee_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('step_id')->references('id')->on('steps')->cascadeOnDelete();

            $table->comment('نمره در مراحل');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
