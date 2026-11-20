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
        Schema::create('assessement_achievement_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessement_activity_id')->constrained('assessement_activities')->restrictOnDelete();

            $table->unsignedBigInteger('student_id');

            $table->foreignId('curriculum_learning_outcome_id')->constrained('curriculum_learning_outcomes')->restrictOnDelete();
            $table->foreignId('curriculum_competency_id')->nullable()->constrained('curriculum_competencies')->restrictOnDelete();
            $table->foreignId('curriculum_assessement_rubric_criterion_id')->nullable()->constrained('curriculum_assessement_rubric_criteria')->restrictOnDelete();
            $table->foreignId('curriculum_assessement_rubric_level_id')->nullable()->constrained('curriculum_assessement_rubric_levels')->restrictOnDelete();

            $table->text('judgement')->nullable();

            $table->decimal('score_value', 8, 2)->nullable();
            $table->text('teacher_feedback')->nullable();

            $table->string('status')->default('draft');

            $table->timestamp('assessed_at')->nullable();


            $table->unsignedBigInteger('assessed_by')->nullable();

            $table->timestamps();

            $table->index(['assessement_activity_id', 'student_id'], 'assessement_achievement_activity_student_index');
            $table->index(['student_id', 'assessed_at'], 'assessement_achievement_student_date_index');
            $table->index('curriculum_learning_outcome_id', 'assessement_achievement_outcome_index');
            $table->index('curriculum_competency_id', 'assessement_achievement_competency_index');
            $table->index('curriculum_assessement_rubric_criterion_id', 'assessement_achievement_criterion_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_achievement_records');
    }
};
