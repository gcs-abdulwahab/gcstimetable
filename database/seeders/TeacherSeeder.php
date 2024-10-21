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
        Teacher::factory()->count(20)->create();

    }
}
