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
        Schema::create('scores', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('examiner_id')->comment('شناسه امتحان دهندگان');
            $table->unsignedBigInteger('criteria_id')->comment('شناسه معیار سنجش');
            $table->unsignedBigInteger('referee_id')->comment('شناسه داور');
            $table->float('score')->comment('نمره');
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('examiners')->cascadeOnDelete();
            $table->foreign('criteria_id')->references('id')->on('criterias')->cascadeOnDelete();
            $table->foreign('referee_id')->references('id')->on('users')->cascadeOnDelete();

            $table->comment('‌نمره کاربر در هر معیار');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
