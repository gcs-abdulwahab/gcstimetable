<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Semester;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 5 to 6 courses of each program in every section

        $semesters = Semester::all();

        $faker = Faker::create();

        foreach ($semesters as $semester) {

            $courseData = [];

            $departmentCode = $semester->program->department->code;

            for ($i = 101; $i <= 105; $i++) {
                $courseName = 'Course Name '.$i; // Replace with your desired pattern
                $courseData[] = [
                    'code' => $departmentCode.'-'.$i.'-'.$semester->name,
                    'name' => $courseName,
                    'credit_hours' => 3,
                    'type' => 'CLASS', // which is by default
                    'is_default' => false, // which is by default
                    'display_code' => $faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
                    'semester_id' => $semester->id,
                ];
            }

            try {
                // save all courses
                $semester->courses()->createMany($courseData);

            } catch (\Throwable $th) {
                //throw $th;
            }

        }

    }
}
