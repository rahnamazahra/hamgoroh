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
        Schema::create('techniques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('challenge_id')->comment('شناسه چالش');
            $table->string('title')->comment('عنوان');
            $table->text('description')->nullable()->comment('توضیحات');
            $table->timestamps();

            $table->foreign('challenge_id')->references('id')->on('challenges')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('techniques');
    }
};
