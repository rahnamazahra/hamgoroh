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
        Schema::create('field_group', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('field_id')->comment('شناسه رشته');
            $table->unsignedBigInteger('group_id')->comment('شناسه گروه');
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->cascadeOnDelete();
            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete();

            $table->comment('اختصاص رشته به گروه');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_group');
    }
};
