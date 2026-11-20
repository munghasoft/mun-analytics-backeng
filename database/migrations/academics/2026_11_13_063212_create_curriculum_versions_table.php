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
        Schema::create('curriculum_versions', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->unique();
            $table->string('education_level');
            $table->string('issuing_body')->nullable();

            $table->date('effective_from');
            $table->date('effective_to')->nullable();
            $table->string('status')->default('draft');

            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['education_level', 'status'], 'curriculum_level_status_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_versions');
    }
};
