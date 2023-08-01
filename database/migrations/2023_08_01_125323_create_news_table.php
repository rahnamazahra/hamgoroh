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
        Schema::create('news', function (Blueprint $table) {
            $table->id()->comment('شناسه');
//            $table->string('image')->comment('نصویر خبر');
            $table->string('title')->comment('عنوان');
            $table->string('sub_title')->nullable()->comment('زیرعنوان');
            $table->string('preview')->nullable()->comment('پیش نمایش');
            $table->text('body')->comment('بدنه');
            $table->boolean('is_published')->comment('منتشر شود / نشود');
            $table->timestamps();

            $table->comment('اخبار');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
