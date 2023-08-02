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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('address')->comment('آدرس');
            $table->integer('postal_code')->nullable()->comment('کد پستی');
            $table->string('phone_number')->comment('شماره تلفن');
            $table->string('email')->nullable()->comment('ایمیل');
            $table->string('body')->nullable()->comment('متن');
            $table->string('telegram')->nullable()->comment('لینک تلگرام');
            $table->string('whatsapp')->nullable()->comment('لینک واتساپ');
            $table->string('instagram')->nullable()->comment('لینک اینستاگرام');
            $table->timestamps();

            $table->comment('تماس با ما');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
