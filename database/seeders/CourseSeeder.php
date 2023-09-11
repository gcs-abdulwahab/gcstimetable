<?php

namespace Database\Seeders;

use App\Models\Section;
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

        $sections = Section::all();

        $faker = Faker::create();

        foreach ($sections as $section) {

            $courseData = [];

           $departmentCode = $section->semester->program->department->code;
            
            for ($i = 101; $i <= 105; $i++) {
                $courseName = "Course Name " . $i; // Replace with your desired pattern
                $courseData[] = [
                    'code' => $departmentCode . '-' . $i . '-' . $section->name,
                    'name' => $courseName,
                    'credit_hours' => 3,
                    'type' => 'CLASS', // which is by default
                    'is_default' => false, // which is by default
                    'display_code' => $faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
                    'section_id' => $section->id,
                ];
            }

            

            try {
            // save all courses
                $section->courses()->createMany($courseData);           
            
            } catch (\Throwable $th) {
                //throw $th;
            }

        
            }



        }


    }

