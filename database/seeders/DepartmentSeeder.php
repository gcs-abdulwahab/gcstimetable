<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Define an array of department names and codes
$departments = [
    ['name' => 'BBA', 'code' => 'BBA'],
    ['name' => 'Botany', 'code' => 'BOT'],
    ['name' => 'Chemistry', 'code' => 'CHEM'],
    ['name' => 'Economics', 'code' => 'ECON'],
    ['name' => 'Education', 'code' => 'EDU'],
    ['name' => 'English', 'code' => 'ENG'],
    ['name' => 'BSCS', 'code' => 'BSCS'],
    ['name' => 'Islamic Studies', 'code' => 'ISL'],
    ['name' => 'Mass Communication', 'code' => 'MC'],
    ['name' => 'Mathematics', 'code' => 'MATH'],
    ['name' => 'Physics', 'code' => 'PHY'],
    ['name' => 'Political Science', 'code' => 'POL'],
    ['name' => 'Sociology', 'code' => 'SOC'],
    ['name' => 'Statistics', 'code' => 'STAT'],
    ['name' => 'Urdu', 'code' => 'URDU'],
    ['name' => 'Zoology', 'code' => 'ZOO'],
];

// Create records for departments using the array
foreach ($departments as $departmentData) {
    Department::create([
        'name' => $departmentData['name'],
        'code' => $departmentData['code'],
    ]);
}



    }
}
