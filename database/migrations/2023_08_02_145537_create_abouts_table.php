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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id()->comment('شناسه');
//            $table->string('image')->nullable()->comment('عکس درباره ما');
            $table->string('preview')->nullable()->comment('پیش نمایش');
            $table->text('body')->comment('متن');
            $table->timestamps();

            $table->comment('درباره ما');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
