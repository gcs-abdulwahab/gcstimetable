<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RoomSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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


    }
}
