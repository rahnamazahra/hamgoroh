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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('examiner_id')->comment('شناسه امتحان دهندگان');
            $table->string('path')->comment('مسیر فایل');
            $table->integer('size')->comment('سایز فایل');
            $table->string('mime')->comment('نوع فایل');
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('examiners')->cascadeOnDelete();
            $table->comment('پاسخ آزمونهای فایلی');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
