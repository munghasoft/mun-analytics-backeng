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
        Schema::create('curriculum_assessement_rubrics', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_subject_requirement_id')->constrained('curriculum_subject_requirements')->restrictOnDelete();
            $table->foreignId('curriculum_assessement_construct_id')->nullable()->constrained('curriculum_assessement_constructs')->restrictOnDelete();

            $table->string('code')->nullable();
            $table->string('name');

            $table->text('description')->nullable();
            $table->string('source_reference')->nullable();

            $table->unsignedInteger('sequence_number')->default(1);

            $table->timestamps();

            $table->unique(['curriculum_subject_requirement_id', 'code'], 'curriculum_assessement_rubric_code_unique');
            $table->index(['curriculum_subject_requirement_id', 'sequence_number'], 'curriculum_assessement_rubric_sequence_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_assessement_rubrics');
    }
};
