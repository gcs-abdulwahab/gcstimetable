<?php

namespace Database\Seeders;

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
        // create 5 to 6 courses of each program in every semester

        $semesters = Semester::all();

        $faker = Faker::create();

        foreach ($semesters as $semester) {

            $courseData = [];

            $departmentCode = $semester->program->department->code;
            
            for ($i = 101; $i <= 103; $i++) {
                $courseName = "Course Name " . $i; // Replace with your desired pattern
                $courseData[] = [
                    'code' => $departmentCode . '-' . $i . '-' . $semester->name,
                    'name' => $courseName,
                    'credit_hours' => 3,
                    'display_code' => $faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
                    'semester_id' => $semester->id,
                ];
            }
            
            $semester->courses()->createMany($courseData);
            
            

            // $courses = CourseFactory::times(rand(5, 6))->create([
            //     'semester_id' => $semester->id,
            // ]);

        
            }
        }


    }

