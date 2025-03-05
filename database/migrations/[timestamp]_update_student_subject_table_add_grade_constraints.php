<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_subjects', function (Blueprint $table) {
            // First drop the existing grade column
            $table->dropColumn('grade');
            
            // Then recreate it with the correct type
            $table->string('grade', 10)->nullable();
        });

        // Add the check constraint with proper MySQL syntax
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

    public function down()
    {
        Schema::table('student_subjects', function (Blueprint $table) {
            DB::statement("ALTER TABLE student_subjects DROP CONSTRAINT check_valid_grade");
            $table->dropColumn('grade');
            $table->decimal('grade', 3, 1)->nullable();
        });
    }
};
