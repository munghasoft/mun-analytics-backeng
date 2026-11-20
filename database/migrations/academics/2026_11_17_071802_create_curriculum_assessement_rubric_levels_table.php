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
        Schema::create('curriculum_assessement_rubric_levels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_assessement_rubric_criterion_id')->constrained('curriculum_assessement_rubric_criteria')->restrictOnDelete();

            $table->string('code')->nullable();
            $table->string('name');
            $table->text('descriptor');

            $table->decimal('score_value', 8, 2)->nullable();

            $table->unsignedInteger('sequence_number')->default(1);
            $table->timestamps();

            $table->unique(['curriculum_assessement_rubric_criterion_id', 'code'], 'curriculum_rubric_level_code_unique');

            $table->index(['curriculum_assessement_rubric_criterion_id', 'sequence_number'], 'curriculum_rubric_level_sequence_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_assessement_rubric_levels');
    }
};
