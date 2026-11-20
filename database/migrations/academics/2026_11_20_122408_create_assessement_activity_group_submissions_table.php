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
        Schema::create('assessement_activity_group_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessement_activity_group_id')->constrained('assessement_activity_groups')->restrictOnDelete();

            $table->unsignedInteger('attempted_number')->default(1);
            $table->string('title');

            $table->text('submission_notes')->nullable();
            $table->unsignedBigInteger('submitted_by')->nullable();

            $table->timestamp('submitted_at')->useCurrent();
            $table->string('status')->default('submitted');
            $table->timestamps();

            $table->unique(['assessement_activity_group_id', 'attempted_number'], 'assessement_group_submission_attempt_unique');

            $table->index(['assessement_activity_group_id', 'status'], 'assessement_group_submission_status_index');

            $table->index('submitted_at', 'assessement_group_submission_date_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_activity_group_submissions');
    }
};
