<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*  $table->string('name');
            // unique code for each teacher  is personnel number
            $table->string('personnel_number')->unique();
            // teacher could either be Lecturer , Assistant Professor , Associate Professor or Professor
            $table->enum('rank', ['Lecturer', 'Assistant Professor','Associate Professor','Professor']);

            // teacher belongs to some department 
            $table->foreignId('department_id')->constrained('departments');
 */

        return [
            //
        ];
    }
}
