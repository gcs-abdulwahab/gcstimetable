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

                // BS Morning Shift = 2
        $programs = [
            ['name' => 'BS BSCS', 'pcode' => 'BS-BSCS', 'dcode' => 'BSCS',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS BSCS', 'pcode' => 'BS-BSCS', 'dcode' => 'BSCS',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS BBA', 'pcode' => 'BS-BBA', 'dcode' => 'BBA',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Botany', 'pcode' => 'BS-BOT', 'dcode' => 'BOT',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Chemistry', 'pcode' => 'BS-CHEM', 'dcode' => 'CHEM',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Economics', 'pcode' => 'BS-ECON', 'dcode' => 'ECON',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Education', 'pcode' => 'BS-EDU', 'dcode' => 'EDU',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS English', 'pcode' => 'BS-ENG', 'dcode' => 'ENG', 'isMorning' =>  true,  'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Islamic Studies', 'pcode' => 'BS-ISL', 'dcode' => 'ISL',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Mass Communication', 'pcode' => 'BS-MC', 'dcode' => 'MC',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Mathematics', 'pcode' => 'BS-MATH', 'dcode' => 'MATH',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'Msc Mathematics', 'pcode' => 'Msc-MATH', 'dcode' => 'MATH',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Physics', 'pcode' => 'BS-PHY', 'dcode' => 'PHY',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Political Science', 'pcode' => 'BS-POL', 'dcode' => 'POL',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Sociology', 'pcode' => 'BS-SOC', 'dcode' => 'SOC',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Statistics', 'pcode' => 'BS-STAT', 'dcode' => 'STAT',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Urdu', 'pcode' => 'BS-URDU', 'dcode' => 'URDU',   'type' => 'BS'          , 'shift_id'=>2               ],
            ['name' => 'BS Zoology', 'pcode' => 'BS-ZOO', 'dcode' => 'ZOO',   'type' => 'BS'          , 'shift_id'=>2               ],
            

            // BS Evening Shift = 3
            ['name' => 'BS BSCS', 'pcode' => 'BS-BSCS', 'dcode' => 'BSCS', 'type' => 'BS'          , 'shift_id'=>3       ],
            ['name' => 'BS BSCS', 'pcode' => 'BS-BSCS', 'dcode' => 'BSCS', 'type' => 'BS'          , 'shift_id'=>3       ],
            ['name' => 'BS BBA', 'pcode' => 'BS-BBA', 'dcode' => 'BBA',    'type' => 'BS'          , 'shift_id'=>3       ],
            ['name' => 'BS BBA', 'pcode' => 'BS-BBA', 'dcode' => 'BBA',    'type' => 'BS'          , 'shift_id'=>3       ],


            // Inter Morning   = 1
            ['name' => 'Fsc Pre Med', 'pcode' => 'Inter-PreMed-I', 'dcode' => 'Inter-FIRST',     'type' => 'inter'          , 'shift_id'=>1               ],
            ['name' => 'Fsc Pre Eng', 'pcode' => 'Inter-PreEng-I', 'dcode' => 'Inter-FIRST',     'type' => 'inter'          , 'shift_id'=>1               ],
            ['name' => 'ICS Phy',     'pcode' => 'Inter-ICSPhy-I',  'dcode' => 'Inter-FIRST',    'type' => 'inter'          , 'shift_id'=>1               ],

            // Inter Evening = 4
            ['name' => 'Fsc Pre Med', 'pcode' => 'Inter-PreMed-I', 'dcode' => 'Inter-FIRST',     'type' => 'inter'          , 'shift_id'=>4               ],
            ['name' => 'Fsc Pre Eng', 'pcode' => 'Inter-PreEng-I', 'dcode' => 'Inter-FIRST',     'type' => 'inter'          , 'shift_id'=>4               ],
            ['name' => 'ICS Phy',     'pcode' => 'Inter-ICSPhy-I',  'dcode' => 'Inter-FIRST',    'type' => 'inter'          , 'shift_id'=>4               ],

            
            

        ];

        // Create records for programs using the array
        foreach ($programs as $programData) {
            // Check if isMorning is true and add "M" suffix to pcode if true
            $pcode = $programData['pcode'];
            $pname = $programData['name'];
            

            if ($programData['type'] === 'BS') {
                // Create a program of type 'BS'
                Program::create([
                    'name' => $pname,
                    'code' => $pcode,
                    'department_id' => Department::where('code', $programData['dcode'])->first()->id,
                    'type' => 'BS',
            
                ]);
            } else {
                // Create a program of type other than 'BS'
                Program::create([
                    'name' => $pname,
                    'code' => $pcode,
                    'department_id' => Department::where('code', $programData['dcode'])->first()->id,
                    'type' => $programData['type'], // Use the provided type
            
                ]);
            }
        }
    }
}
