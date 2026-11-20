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
        Schema::create('curriculum_subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculun_version_id')->constrained('curriculum_versions')->restrictOnDelete();

            $table->string('name');
            $table->string('code')->nullable();

            $table->text('description')->nullable();

            $table->unique(['curriculum_version_id', 'name'], 'curriculun_subject_name_unique');
            $table->unique(['curriculum_version_id', 'code'], 'curriculun_subject_code_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_subjects');
    }
};
