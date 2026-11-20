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
        Schema::create('exam_subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_id')->constrained('exams')->restrictOnDelete();
            $table->foreignId('class_subject_id')->constrained('class_subjects')->restrictOnDelete();

            $table->decimal('max_marks', 8, 2);
            $table->decimal('pass_marks', 8, 2)->nullable();

            $table->unique(['exam_id', 'class_subject_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_subjects');
    }
};
