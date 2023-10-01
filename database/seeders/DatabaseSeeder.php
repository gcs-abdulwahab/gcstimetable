<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Database\Seeders\InstitutionSeeder;
use Database\Seeders\RoomSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // call seeder of user
        User::factory()->create([
            'name' => 'abdul Wahab',
            'email' => 'abdulwahab@gmail.com',
            'password' => bcrypt('abdulwahab@gmail.com'),
        ]
        );        


        // call seeder of institution
        $this->call(InstitutionSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // call seeder of room
        $this->call(RoomSeeder::class);
        // call seeder of department
         $this->call(DepartmentSeeder::class);
        // // call seeder of slot
        $this->call(SlotSeeder::class);
        // call seeder of day
        $this->call(DaySeeder::class);
        // call ProgramSeeder
        $this->call(ProgramSeeder::class);
            // call TeacherSeeder
        $this->call(TeacherSeeder::class);
            // call SemesterSeeder
        $this->call(SemesterSeeder::class);
        // call SectionSeeder
        $this->call(SectionSeeder::class);

        // call Course Seeder
        $this->call(CourseSeeder::class);


        // call AllocationSeeder
        $this->call(AllocationSeeder::class);

        // call StudentSeeder
        $this->call(StudentSeeder::class);

    }
}
