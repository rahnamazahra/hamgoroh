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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('first_name')->comment('نام');
            $table->string('last_name')->comment('نام خانوادگی');
            $table->boolean('is_active')->comment('وضعیت فعال');
            $table->string('phone')->unique()->nullable()->comment('شماره تلفن‌همراه');
            $table->timestamp('phone_verified_at')->nullable()->nullable()->comment('اعتبارسنجی موبایل');
            $table->string('password')->nullable()->comment('گذرواژه');
            $table->unsignedBigInteger('city_id')->nullable()->comment('شناسه شهرستان');
            $table->unsignedBigInteger('province_id')->nullable()->comment('شناسه استان');
            $table->string('national_code')->unique()->nullable()->comment('کدملی');
            $table->boolean('gender')->nullable()->comment('جنسیت');
            $table->date('birthday_date')->nullable()->comment('تاریخ تولد');
            $table->json('meta')->nullable()->comment('اطلاعات تکمیلی');
            $table->unsignedBigInteger('creator')->nullable()->comment('کاربر ایجاد کننده');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->constrained()->nullOnDelete();
            $table->foreign('province_id')->references('id')->on('provinces')->constrained()->nullOnDelete();

            $table->comment('کاربران');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
