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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id')->comment('شناسه مرحله');
            $table->unsignedBigInteger('criteria_id')->comment('شناسه معیار');
            $table->integer('point')->comment('نمره');
            $table->enum('refereeing_type', ['first', 'average'])->comment('نوع داوری');
            $table->timestamps();

            $table->foreign('step_id')->references('id')->on('steps')->cascadeOnDelete();

            $table->comment('ارزیابی');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
