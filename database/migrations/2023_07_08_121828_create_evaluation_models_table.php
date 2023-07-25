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
        Schema::create('evaluation_models', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('title')->comment('عنوان');
            $table->timestamps();

            $table->comment('مدل‌های ارزیابی');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_models');
    }
};
