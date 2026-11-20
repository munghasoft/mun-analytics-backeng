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
        Schema::create('curriculum_subject_requirements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_subject_id')->constrained('curriculum_subjects')->restrictOnDelete();

            $table->string('class_level');
            $table->string('requirement_type');
            $table->string('selection_group')->nullable();

            $table->text('description')->nullable();

            $table->unique(['curriculum_subject_id', 'class_level'], 'curriculum_subject_level_unique');

            $table->index(['class_level', 'requirement_type'], 'curriculum_level_requirement_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_subject_requirements');
    }
};
