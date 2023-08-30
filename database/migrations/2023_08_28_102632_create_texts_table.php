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
        Schema::create('texts', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('examiner_id')->comment('شناسه امتحان دهندگان');
            $table->text('text')->comment('متن');
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('examiners')->cascadeOnDelete();
            $table->comment('پاسخ آزمونهای متنی');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts');
    }
};
