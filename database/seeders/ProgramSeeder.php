<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        /*
        Create the Program of the following departments 
BSCS
BBA
Botany
Chemistry
Economics
Education
English
Islamic Studies
Mass Commmunication
Mathematics
Physics
Political Science
Sociology
Statistics
Urdu
Zoology
 */

// Define an array of department names and their respective codes, indicating which have both morning and evening programs
$departments = [
    ['name' => 'BSCS', 'code' => 'BSCS', 'hasMorningEvening' => true],
    ['name' => 'BBA', 'code' => 'BBA', 'hasMorningEvening' => true],
    ['name' => 'Botany', 'code' => 'BOT', 'hasMorningEvening' => false],
    ['name' => 'Chemistry', 'code' => 'CHEM', 'hasMorningEvening' => false],
    ['name' => 'Economics', 'code' => 'ECON', 'hasMorningEvening' => false],
    ['name' => 'Education', 'code' => 'EDU', 'hasMorningEvening' => false],
    ['name' => 'English', 'code' => 'ENG', 'hasMorningEvening' => false],
    ['name' => 'Islamic Studies', 'code' => 'ISL', 'hasMorningEvening' => false],
    ['name' => 'Mass Communication', 'code' => 'MC', 'hasMorningEvening' => false],
    ['name' => 'Mathematics', 'code' => 'MATH', 'hasMorningEvening' => false],
    ['name' => 'Physics', 'code' => 'PHY', 'hasMorningEvening' => false],
    ['name' => 'Political Science', 'code' => 'POL', 'hasMorningEvening' => false],
    ['name' => 'Sociology', 'code' => 'SOC', 'hasMorningEvening' => false],
    ['name' => 'Statistics', 'code' => 'STAT', 'hasMorningEvening' => false],
    ['name' => 'Urdu', 'code' => 'URDU', 'hasMorningEvening' => false],
    ['name' => 'Zoology', 'code' => 'ZOO', 'hasMorningEvening' => false],
];

$programs = [];

foreach ($departments as $departmentData) {
    // Find the department by code
    $department = Department::where('code', $departmentData['code'])->first();

    if ($department) {
        // Create the morning program
        $programs[] = [
            'name' => $departmentData['name'] . ' (Morning)',
            'code' => $departmentData['code'] . '-M',
            'department_id' => $department->id,
            'isMorning' => true,
        ];

        // Create the evening program if the department has both
        if ($departmentData['hasMorningEvening']) {
            $programs[] = [
                'name' => $departmentData['name'] . ' (Evening)',
                'code' => $departmentData['code'] . '-E',
                'department_id' => $department->id,
                'isMorning' => false,
            ];
        }
    } else {
        // Handle the case where the department does not exist (optional)
        // You can log an error or take appropriate action here.
    }
}

// Create the programs
foreach ($programs as $programData) {
    Program::create($programData);
}
 

     










    }
}
