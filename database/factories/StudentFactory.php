<?php

namespace Database\Factories;

use App\Models\Program;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $program = Program::inRandomOrder()->with(['semesters' => function ($query) {
            $query->select('id')->inRandomOrder()->first();
        }])->first();

        return [
            'name'          => fake()->name(),
            'email'         => fake()->unique()->safeEmail(),
            'mobile'        => fake()->phoneNumber(),
            'program_id'    => $program->id ?? null,
            'semester_id'   => $program->semesters->first()->id ?? null,
        ];
    }
}
