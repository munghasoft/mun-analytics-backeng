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
        Schema::create('curriculum_assessement_rubric_criteria', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_assessement_rubric_id')->constrained('curriculum-assessement_rubrics')->restrictOnDelete();
            $table->string('code')->nullable();
            $table->string('name');

            $table->text('description')->nullable();

            $table->unsignedInteger('sequence_number')->default(1);
            
            $table->timestamps();

            $table->unique(['curriculum_assessement_rubric_id', 'code'], 'curriculum_rubric_criterion_code_unique');
            $table->index(['curriculum_assessement_rubric_id', 'sequence_number'], 'curriculum_rubric_criterion_sequence_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_assessement_rubric_criteria');
    }
};
