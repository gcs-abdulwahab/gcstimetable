<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
                    $table->string('name');
            // unique code for each teacher  is personnel number
            $table->string('personnel_number')->unique();
            // teacher email
            $table->string('email')->unique();

            // teacher cnic
            $table->string('cnic')->unique();
            // teacher phone number
            $table->string('phone_number')->unique();
            // teacher bank IBAN
            $table->string('bank_iban')->unique();

            // teacher could either be Lecturer , Assistant Professor , Associate Professor or Professor
            $table->enum('rank', ['Lecturer', 'Assistant Professor','Associate Professor','Professor'])->default('Lecturer');

            // teacher belongs to some department
            $table->foreignId('department_id')->constrained('departments');
            //isvisiting
            $table->boolean('isvisiting')->default(false);

        */

        // Assuming you have the Teacher and Department models defined and a database connection set up.

        //        $faker = Faker::create();
        //
        //        $departments = Department::all();
        //
        //        foreach ($departments as $department) {
        //            $teacherCount = rand(3, 12);
        //
        //            for ($i = 0; $i < $teacherCount; $i++) {
        //                Teacher::create([
        //                    'name' => $faker->name,
        //                    'personnel_number' => $faker->unique()->randomNumber(6),
        //                    'email' => $faker->unique()->safeEmail,
        //                    'cnic' => $faker->unique()->numerify('#############'),
        //                    'phone_number' => $faker->unique()->phoneNumber,
        //                    'bank_iban' => $faker->unique()->numerify('#######################'),
        //                    'rank' => 'Assistant Professor', // You can change this as needed
        //                    'department_id' => $department->id,
        //                    'isvisiting' => false,
        //                ]);
        //            }
        //        }

        Teacher::factory()->count(20)->create();

    }
}
