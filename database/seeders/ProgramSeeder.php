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



      // Define an array of department names and their respective codes, indicating which have both morning and evening programs
$programs = [
    ['name' => 'BS BSCS', 'pcode' => 'BS-BSCS', 'dcode' => 'BSCS', 'isMorning' => false   ,  'type'=>'BS'  ],
    ['name' => 'BS BSCS', 'pcode' => 'BS-BSCS', 'dcode' => 'BSCS', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS BBA', 'pcode' => 'BS-BBA', 'dcode' => 'BBA', 'isMorning' => false   ,  'type'=>'BS'  ],
    ['name' => 'BS Botany', 'pcode' => 'BS-BOT', 'dcode' => 'BOT', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Chemistry', 'pcode' => 'BS-CHEM', 'dcode' => 'CHEM', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Economics', 'pcode' => 'BS-ECON', 'dcode' => 'ECON', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Education', 'pcode' => 'BS-EDU', 'dcode' => 'EDU', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS English', 'pcode' => 'BS-ENG', 'dcode' => 'ENG', 'isMorning' =>  true  ,  'type'=>'BS'  ],
    ['name' => 'BS Islamic Studies', 'pcode' => 'BS-ISL', 'dcode' => 'ISL', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Mass Communication', 'pcode' => 'BS-MC', 'dcode' => 'MC', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Mathematics', 'pcode' => 'BS-MATH', 'dcode' => 'MATH', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'Msc Mathematics', 'pcode' => 'Msc-MATH', 'dcode' => 'MATH', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Physics', 'pcode' => 'BS-PHY', 'dcode' => 'PHY', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Political Science', 'pcode' => 'BS-POL', 'dcode' => 'POL', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Sociology', 'pcode' => 'BS-SOC', 'dcode' => 'SOC', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Statistics', 'pcode' => 'BS-STAT', 'dcode' => 'STAT', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Urdu', 'pcode' => 'BS-URDU', 'dcode' => 'URDU', 'isMorning' => true   ,  'type'=>'BS'  ],
    ['name' => 'BS Zoology', 'pcode' => 'BS-ZOO', 'dcode' => 'ZOO', 'isMorning' => true   ,  'type'=>'BS'  ],
    
    ['name' => 'Fsc Pre Med', 'pcode' => 'Inter-PreMed-I', 'dcode' => 'Inter-FIRST',     'type'=>'inter' ,'isMorning' => true],
    ['name' => 'Fsc Pre Med', 'pcode' => 'Inter-PreMed-I', 'dcode' => 'Inter-FIRST',     'type'=>'inter','isMorning' => false],
    ['name' => 'Fsc Pre Eng', 'pcode' => 'Inter-PreEng-I', 'dcode' => 'Inter-FIRST',     'type'=>'inter' ,'isMorning' => true],
    ['name' => 'Fsc Pre Eng', 'pcode' => 'Inter-PreEng-I', 'dcode' => 'Inter-FIRST',     'type'=>'inter','isMorning' => false],
    ['name' => 'ICS Phy',     'pcode' => 'Inter-ICSPhy-I',  'dcode' => 'Inter-FIRST',    'type'=>'inter','isMorning' => false],
    ['name' => 'ICS Phy',     'pcode' => 'Inter-ICSPhy-I',  'dcode' => 'Inter-FIRST',    'type'=>'inter' ,'isMorning' => true],
    
    ['name' => 'Fsc Pre Med', 'pcode' => 'Inter-PreMed=II', 'dcode' => 'Inter-SECOND',    'type'=>'inter' ,'isMorning' => true],
    ['name' => 'Fsc Pre Med', 'pcode' => 'Inter-PreMed=II', 'dcode' => 'Inter-SECOND',    'type'=>'inter','isMorning' => false],
    ['name' => 'Fsc Pre Eng', 'pcode' => 'Inter-PreEng=II', 'dcode' => 'Inter-SECOND',    'type'=>'inter' ,'isMorning' => true],
    ['name' => 'Fsc Pre Eng', 'pcode' => 'Inter-PreEng=II', 'dcode' => 'Inter-SECOND',    'type'=>'inter','isMorning' => false],
    ['name' => 'ICS Phy',     'pcode' => 'Inter-ICSPhy=II', 'dcode' => 'Inter-SECOND',    'type'=>'inter' ,'isMorning' => true],
    ['name' => 'ICS Phy',     'pcode' => 'Inter-ICSPhy=II', 'dcode' => 'Inter-SECOND',    'type'=>'inter','isMorning' => false],

    
    

        ];

        // Create records for programs using the array
foreach ($programs as $programData) {
    // Check if isMorning is true and add "M" suffix to pcode if true
    $pcode = $programData['pcode'];
            $pname = $programData['name'];
    if ($programData['isMorning']) {
        $pcode .= '-M';
        $pname .= '-M';
        
    }
    else
    {
        $pcode .= '-E';
        $pname .= '-E';
    }

    if ($programData['type'] === 'BS') {
        // Create a program of type 'BS'
        Program::create([
            'name' => $pname,
            'code' => $pcode,
            'department_id' => Department::where('code', $programData['dcode'])->first()->id,
            'type' => 'BS',
            'isMorning' => $programData['isMorning'],
        ]);
    } else {
        // Create a program of type other than 'BS'
        Program::create([
            'name' => $pname,
            'code' => $pcode,
            'department_id' => Department::where('code', $programData['dcode'])->first()->id,
            'type' => $programData['type'], // Use the provided type
            'isMorning' => $programData['isMorning'],
        ]);
    }
    
}













        }
    }

