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
        Schema::create('assessement_activity_group_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessement_activity_group_id')->constrained('assessement_activity_groups')->restrictOnDelete();

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('added_by')->nullable();

            $table->timestamp('joined_at')->useCurrent();

            $table->timestamps();

            $table->unique(['assessement_activity_group_id', 'student_id'], 'assessement_group_member_unique');

            $table->index('student_id', 'assessement_grouup_member_student_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_activity_group_members');
    }
};
