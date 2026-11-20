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
        Schema::create('attendance_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academic_term_id')->constrained('academic_terms')->restrictOnDelete();
            $table->foreignId('class_id')->constrained('classes')->restrictOnDelete();
            $table->foreignId('stream_id')->nullable()->constrained('streams')->restrictOnDelete();

            $table->date('attendance_date');
        
            $table->string('status')->default('draft');

            $table->unsignedBigInteger('recorded_by')->nullable();
            $table->unsignedBigInteger('stream_scope_key')->storedAs('COALESCE(stream_id, 0)');


            $table->unique(['class_id', 'attendance_date', 'stream_scope_key'], 'attendance_register_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_sessions');
    }
};
