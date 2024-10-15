<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. 👌
     */
    public function up(): void
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();

            // foreign key to course 📚
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();
            // foreign key to teacher 👨‍🏫
            $table->foreignId('teacher_id')->nullable()->constrained()->cascadeOnDelete();
            // foreign key to room 🏢
            $table->foreignId('room_id')->nullable()->constrained()->cascadeOnDelete();
            // foreign key to day 📅
            $table->foreignId('day_id')->constrained()->cascadeOnDelete();
            // foreign key to slot ⏰
            $table->foreignId('slot_id')->constrained()->cascadeOnDelete();
            // foreign key to section 🧑‍🎓
            $table->foreignId('section_id')->nullable()->constrained()->cascadeOnDelete();
            // foreign key to timetables ⏲️
            $table->foreignIdFor(\App\Models\TimeTable::class)->constrained()->cascadeOnDelete();

            // Allocation Name
            $table->string('name')->nullable();

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
