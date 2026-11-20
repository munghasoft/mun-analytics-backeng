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
        Schema::create('assessement_activity_groups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessement_activity_id')->constrained('assessement_activities')->restrictOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            $table->unique(['assessement_activity', 'name'], 'assessement_activity_group_name_unique');

            $table->index('assessement_activity_id', 'asseseement_activity_group_activity_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessement_activity_groups');
    }
};
