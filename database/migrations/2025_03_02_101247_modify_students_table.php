<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->integer('age')->nullable()->change();
            $table->string('year_level')->nullable()->change();
            
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('address')->nullable(false)->change(); 
            $table->integer('age')->nullable(false)->change(); 
            $table->string('year_level')->nullable(false)->change();
        });
    }
};

