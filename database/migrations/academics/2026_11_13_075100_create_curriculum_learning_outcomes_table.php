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
        Schema::create('curriculum_learning_outcomes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_subject_requirement_id')->constrained('curriculum_subject_requirements')->restrictOnDelete();

            $table->string('code')->nullable();
            $table->string('title');

            $table->text('description')->nullable();

            $table->unsignedBigInteger('sequence_number')->default(1);
            $table->timestamps();

            $table->unique(['curriculum_subject_requirement_id', 'code'], 'curriculum_outcome_code_unique');
            $table->index(['curriculum_subject_requirement_id', 'sequence_number'], 'curriculum_outcome_sequence_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_learning_outcomes');
    }
};
