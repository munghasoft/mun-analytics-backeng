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
        Schema::create('fee_structure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('school')->onDelete('cascade');
            $table->string('class_name');
            $table->string('term');
            $table->integer('year');
            $table->decimal('total_day', 15, 2)->default(0);
            $table->decimal('total_boarder', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structure');
    }
};
