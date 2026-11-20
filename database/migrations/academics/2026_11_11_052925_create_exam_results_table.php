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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_subject_id')->constrained('exam_subjects')->restrictOnDelete();
            $table->unsignedBigInteger('student_id');
            $table->decimal('marks_obtained', 8, 2)->nullable();
            $table->string('status')->default('present');
            $table->text('remarks')->nullable();

            $table->unique(['exam_subject_id', 'student_id']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
