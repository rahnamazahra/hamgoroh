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
        Schema::create('news_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_category_id')->comment('شناسه دسته بندی');
            $table->unsignedBigInteger('news_id')->comment('شناسه خبر');

            $table->foreign('news_category_id')->references('id')->on('news_categories')->cascadeOnDelete();
            $table->foreign('news_id')->references('id')->on('news')->cascadeOnDelete();
            $table->timestamps();

            $table->comment('اختصاص دسته بندی به خبر');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_tags');
    }
};
