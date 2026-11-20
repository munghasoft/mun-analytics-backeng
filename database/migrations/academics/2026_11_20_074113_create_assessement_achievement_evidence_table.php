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
        Schema::create('assessement_achievement_evidence', function (Blueprint $table) {
            
            $table->foreignId('assessement_evidence_record_id')->constrained('assessement_evidence_records')->restrictOnDelete();

            $table->unsignedBigInteger('linked_by')->nullable();

            $table->timestamp('linked_at')->useCurrent();

            $table->unique(['assessement_achievement_record_id', 'assessement_evidence_records'], 'assessement_achievement_evidence_unique');

            $table->index('assessement_evidence_record_id', 'assessement_achievement_evidence_lookup_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_achievement_evidence');
    }
};
