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
        Schema::create('evaluation_referees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id')->comment('شناسه ارزیابی');
            $table->unsignedBigInteger('referee_id')->comment('شناسه داور');
            $table->timestamps();

            $table->foreign('evaluation_id')->references('id')->on('evaluations')->cascadeOnDelete();
            $table->foreign('referee_id')->references('id')->on('users')->cascadeOnDelete();

            $table->comment('انتساب داور به ارزیابی');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_referee');
    }
};
