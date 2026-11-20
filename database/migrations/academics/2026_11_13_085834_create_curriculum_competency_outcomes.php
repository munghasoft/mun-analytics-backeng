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
        Schema::create('curriculum_competency_outcomes', function (Blueprint $table) {

            $table->foreignId('curriculum_competency_id')->constrained('curriculum_competencies')->restrictOnDelete();
            $table->foreignId('curriculum_learning_outcome_id')->constrained('curriculum_learning_outcomes')->restrictOnDelete();

            $table->unique(['curriculum_competency_id', 'curriculum_learning_outcome_id'], 'curriculum_competency_outcome_unique');

            $table->index('curriculum_learning_outcome_id', 'curriculum_outcome_lookup_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_competency_outcomes');
    }
};
