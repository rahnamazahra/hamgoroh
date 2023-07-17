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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('title')->nullable()->comment('عنوان فارسی');
            $table->string('slug')->comment('عنوان لاتین');
            $table->text('description')->nullable()->comment('توضیحات');
            $table->timestamps();

            $table->comment('دسترسی‌ها');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
