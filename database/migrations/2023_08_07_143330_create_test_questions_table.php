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
        Schema::create('test_questions', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('test_id')->comment('شناسه آزمون');
            $table->text('title')->comment('صورت سوال');
            $table->string('correct_answer')->comment('گزینه صحیح');
            $table->json('ancillary_answer')->nullable()->comment('گزینه صحیح فرعی');
            $table->text('option_one')->comment('گزینه اول');
            $table->text('option_two')->comment('گزینه دوم');
            $table->text('option_three')->comment('گزینه سوم');
            $table->text('option_four')->comment('گزینه چهارم');
            $table->enum('level', ['easy','normal','hard'])->comment('سطح سوال');
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('tests')->cascadeOnDelete();

            $table->comment('سوالات آزمون چهارگزینه ای');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_questions');
    }
};
