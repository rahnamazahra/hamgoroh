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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');
            $table->integer('weight')->comment('ضریب');
            $table->enum('level', ['provincial', 'country'])->comment('سطح برگذاری مسابقات');
            $table->enum('type', ['video_upload', 'image_upload', 'voice_upload', 'document_upload', 'text', 'call', 'test', 'video_online'])->comment('نوع آزمون مسابقات');
            $table->unsignedBigInteger('challenge_id')->comment('شناسه چالش');
            $table->unsignedBigInteger('group')->comment('شناسه گروه');
            $table->timestamps();

            $table->foreign('challenge_id')->references('id')->on('challenges')->cascadeOnDelete();

            $table->comment('مراحل چالش');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
