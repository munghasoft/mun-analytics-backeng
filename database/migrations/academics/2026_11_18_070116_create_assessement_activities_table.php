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
        Schema::create('assessement_activities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id');

            $table->foreignId('academic_term_id')->constrained('academic_terms')->restrictOnDelete();
            $table->foreignId('class_subject_id')->constrained('class_subjects')->restrictOnDelete();
            $table->foreignId('curriculum_assessement_type_id')->nullable()->constrained('curruculum_assessement_types')->restrictOnDelete();

            $table->string('title');

            $table->text('instructions')->nullable();

            $table->date('assessement_date')->nullable();
            $table->date('due_date')->nullable();

            $table->decimal('max_score', 8, 2)->nullable();
            $table->string('status')->default('draft');

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps('published_at')->nullable();
            $table->timestamps();

            $table->index(['school_id', 'academic_term_id'], 'assessement_activity_school_term_index');
            $table->index(['class_subject_id', 'status'], 'assessement_activity_subject_status_index');
            $table->index(['academic_term_id', 'assement_date'], 'assessement_activity_term_date_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_activities');
    }
};
