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
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            
            // foreign key to course
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            // foreign key to teacher
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade')->nullable();
            // foreign key to room
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            // foreign key to day
            $table->foreignId('day_id')->constrained()->onDelete('cascade');
            // foreign key to slot
            $table->foreignId('slot_id')->constrained()->onDelete('cascade');
            // foreign key to section
            $table->foreignId('section_id')->constrained()->onDelete('cascade');

            // Allocation Name
            $table->string('name')->nullable();

            // unique constraint
            $table->unique(['course_id', 'teacher_id', 'room_id', 'day_id', 'slot_id'])->name('course_teacher_room_day_slot_unique');

            // Unique Constraint A room cannot be allocated to same slot on same day to two different courses
             $table->unique(['room_id', 'day_id', 'slot_id'])->name('room_day_slot_unique :A room cannot be allocated to same slot on same day to two different courses');

            // More Constraints  to come or they can be put in the Rules
            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
