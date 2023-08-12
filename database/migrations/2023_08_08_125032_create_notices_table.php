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
        Schema::create('notices', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->string('title')->comment('عنوان');
            $table->text('description')->comment('متن');
            $table->boolean('is_sent_users')->default(false)->comment('ارسال به همه کاربران');
            $table->boolean('is_sent_referees')->default(false)->comment('ارسال به همه داوران');
            $table->boolean('is_sent_generals')->default(false)->comment('ارسال به همه مدیران کل');
            $table->boolean('is_sent_provincials')->default(false)->comment('ارسال به همه مدیران استانی');
            $table->json('selected_users')->nullable()->comment('ارسال به کاربران انتخاب شده');
            $table->timestamps();

            $table->comment('اطلاعیه ها');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
