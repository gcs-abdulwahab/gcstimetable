<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Day;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Allocation>
 */
class AllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
/* 
            // foreign key to course
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            // foreign key to teacher
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            // foreign key to room
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            // foreign key to day
            $table->foreignId('day_id')->constrained()->onDelete('cascade');
            // foreign key to slot
            $table->foreignId('slot_id')->constrained()->onDelete('cascade');
 */
        $faker = $this->faker;
        
$faker->seed(1234);

        $num = $faker->unique()->numberBetween(1, 1000);
        return [


            
            // foreign key to course
            'course_id' => Course::inRandomOrder(    $num      )->pluck('id')->first(),
            // foreign key to teacher
            'teacher_id' => Teacher::inRandomOrder(    $num      )->pluck('id')->first(),
            // foreign key to room
            'room_id' =>  Room::inRandomOrder(    $num      )->pluck('id')->first(),
            // foreign key to day
            'day_id' =>  Day::inRandomOrder(    $num      )->pluck('id')->first(),
            // foreign key to slot
            'slot_id' =>   Slot::inRandomOrder(    $num      )->pluck('id')->first(),
        ];
    }
}
