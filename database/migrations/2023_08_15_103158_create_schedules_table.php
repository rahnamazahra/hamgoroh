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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('step_id')->comment('شناسه مرحله');
            $table->unsignedBigInteger('user_id')->nullable()->comment('شناسه کاربر');
            $table->boolean('is_reserved')->default(false)->comment('رزروشده/نشده');
            $table->dateTime('from_time')->comment('از تاریخ');
            $table->dateTime('to_time')->comment('تا تاریخ');
            $table->timestamps();

            $table->foreign('step_id')->references('id')->on('steps')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
