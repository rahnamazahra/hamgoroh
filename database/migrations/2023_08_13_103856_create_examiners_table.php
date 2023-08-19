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
        Schema::create('examiners', function (Blueprint $table) {
            $table->id()->comment('شناسه');
            $table->unsignedBigInteger('participant_id')->comment('شناسه شرکت کننذگان');
            $table->unsignedBigInteger('technique_id')->comment('شناسه تکنیک');
            $table->unsignedBigInteger('step_id')->comment('شناسه مرحله');
            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete();
            $table->foreign('technique_id')->references('id')->on('techniques')->cascadeOnDelete();
            $table->foreign('step_id')->references('id')->on('steps')->cascadeOnDelete();

            $table->comment('امتحان دهندگان');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examiners');
    }
};
