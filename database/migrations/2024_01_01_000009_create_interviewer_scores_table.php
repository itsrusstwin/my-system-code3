<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviewer_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interviewer_question_id')
                ->constrained('interviewer_questions')
                ->cascadeOnDelete();
            $table->foreignId('interview_applicant_id')
                ->constrained('interview_applicants')
                ->cascadeOnDelete();
            $table->foreignId('interview_id')
                ->constrained('interviews')
                ->cascadeOnDelete();
            $table->integer('score');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviewer_scores');
    }
};
