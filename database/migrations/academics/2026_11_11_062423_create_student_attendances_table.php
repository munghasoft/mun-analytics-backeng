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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attendance_session_id')->constrained('attendance_sessions')->restrictOnDelete();

            $table->unsignedBigInteger('student_id');
            $table->date('attendance_date');
            $table->string('status');
            $table->text('remarks')->nullable();

            $table->unique(['attendance_date', 'student_id'], 'student_daily_attendance_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
