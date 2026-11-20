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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academic_term_id')->constrained('academic_terms')->restrictOnDelete();

            $table->string('name');
            $table->string('exam_type');

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->string('status')->default('scheduled');

            $table->unique(['academic_term_id', 'name']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
