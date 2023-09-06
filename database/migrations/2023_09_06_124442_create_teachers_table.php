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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // unique code for each teacher  is personnel number
            $table->string('personnel_number')->unique();
            // teacher could either be Lecturer , Assistant Professor , Associate Professor or Professor
            $table->enum('rank', ['Lecturer', 'Assistant Professor','Associate Professor','Professor']);

            // teacher belongs to some department 
            $table->foreignId('department_id')->constrained('departments');
            //isvisiting
            $table->boolean('isvisiting')->default(false);
            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
