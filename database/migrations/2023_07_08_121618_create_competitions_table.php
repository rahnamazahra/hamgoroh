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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('title')->comment('عنوان');
            $table->boolean('is_active')->comment('وضعیت غیرفعال / فعال');
            $table->dateTime('registration_start_time')->comment('زمان شروع ثبت نام');
            $table->dateTime('registration_finish_time')->comment('زمان پایان ثبت نام');
            $table->text('registration_description')->nullable()->comment('توضیحات ثبت نام');
            $table->text('rules_description')->nullable()->comment('قوانین');
            $table->text('letter_method')->nullable()->comment('شیوه نامه');
            $table->text('banner')->nullable()->comment('بنر');
            $table->unsignedBigInteger('creator')->nullable()->comment('شناسه کاربر ایجاد کننده');
            $table->timestamps();

            $table->foreign('creator')->references('id')->on('users')->cascadeOnDelete();

            $table->comment('دوره‌های مسابقات');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
