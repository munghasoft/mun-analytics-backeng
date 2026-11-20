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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->restrictOnDelete();

            $table->string('admission_no');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');

            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_address')->nullable();

            $table->unique(['school_id', 'admission_no']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
