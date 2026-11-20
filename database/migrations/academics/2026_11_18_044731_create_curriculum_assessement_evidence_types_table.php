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
        Schema::create('curriculum_assessement_evidence_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_version_id')->constrained('curriculum_versions')->restrictOnDelete();

            $table->string('code')->nullable();
            $table->string('name');

            $table->text('description')->nullable();
            $table->string('source_reference')->nullable();

            $table->unsignedInteger('sequence_number')->default(1);
            $table->timestamps();

            $table->unique(['curriculum_version_id', 'code'], 'curriculum_evidence_type_code_unique');

            $table->index(['curriculum_version_id', 'sequence_number'], 'curriculum_evidence_type_sequence_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_assessement_evidence_types');
    }
};
