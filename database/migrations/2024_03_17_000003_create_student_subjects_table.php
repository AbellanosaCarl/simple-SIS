<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('grade', 10)->nullable();
            $table->timestamps();
            
            $table->unique(['student_id', 'subject_id']);
        });

        // Add the check constraint after table creation
        DB::statement("
            ALTER TABLE student_subjects
            ADD CONSTRAINT check_valid_grade
            CHECK (
                grade IS NULL 
                OR grade = 'INC'
                OR (
                    CAST(grade AS DECIMAL(3,1)) BETWEEN 1.0 AND 5.0
                )
            )
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('student_subjects');
    }
};