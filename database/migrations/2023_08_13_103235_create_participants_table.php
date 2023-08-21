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
        Schema::create('participants', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('user_id')->comment('شناسه کاربر');
            $table->unsignedBigInteger('competition_id')->comment('شناسه دوره');
            $table->unsignedBigInteger('field_id')->comment('شناسه رشته');
            $table->unsignedBigInteger('challenge_id')->comment('شناسه چالش');
            $table->float('score', 4, 2)->nullable()->comment('نمره');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('competition_id')->references('id')->on('competitions')->cascadeOnDelete();
            $table->foreign('field_id')->references('id')->on('fields')->cascadeOnDelete();
            $table->foreign('challenge_id')->references('id')->on('challenges')->cascadeOnDelete();

            $table->comment('شرکت کنندگان');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
