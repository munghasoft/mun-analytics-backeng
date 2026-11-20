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
        Schema::create('assessement_evidence_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessement_activity_id')->constrained('assessement_activities')->restrictOnDelete();

            $table->unsignedBigInteger('student_id');

            $table->foreignId('curriculum_assessement_evidence_type_id')->nullable()->constrained('curriculum_assessement_evidence_types')->restrictOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            $table->date('evidence_date')->nullable();

            $table->string('file_disk')->nullable();
            $table->string('file_path')->nullable();
            $table->string('original_file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->string('external_reference')->nullable();

            $table->unsignedBigInteger('recorded_by')->nullable();

            $table->timestamps();

            $table->index(['assessement_activity_id', 'student_id'], 'assessement_evidence_activity_student_index');
            $table->index(['student_id', 'evidence_id'], 'assessement_evidence_student_date_index');
            $table->index('curriculum_assessement_evidence_type_id', 'assessement_evidence_type_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_evidence_records');
    }
};
