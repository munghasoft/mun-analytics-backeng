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
        Schema::create('assessement_activity_participants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessement_activity_id')->constrained('assessement_activities')->restrictOnDelete();
            $table->unsignedBigInteger('student_id');

            $table->string('participation_type')->default('individual');
            $table->string('status')->default('assigned');

            $table->timestamp('participated_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['assessement_activity_id', 'student_id'], 'assessement_activity_student_unique');

            $table->index(['student_id', 'status'], 'assessement_participant_student_status_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_activity_participants');
    }
};
