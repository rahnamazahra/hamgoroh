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
        Schema::create('tests', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('title')->comment('عنوان آزمون');
            $table->enum('show_question', ['single', 'all'])->comment('نمایش سوالات همه/تکی');
            $table->boolean('is_random')->default(false)->comment('نمایش رندم گزینه ها');
            $table->boolean('is_limit')->default(false)->comment('محدودیت زمان ورود');
            $table->boolean('is_negative')->default(false)->comment('نمره منفی');
            $table->boolean('is_score')->default(false)->comment('نمایش نمره');
            $table->integer('duration')->comment('مدت زمان آزمون');
            $table->integer('easy_count')->comment('تعداد سوالات آسان');
            $table->integer('normal_count')->comment('تعداد سوالات متوسط');
            $table->integer('hard_count')->comment('تعداد سوالات سخت');
            $table->integer('all_count')->comment('تعداد کل سوالات');
            $table->timestamps();

            $table->comment('آزمون های چهارگزینه ای');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
