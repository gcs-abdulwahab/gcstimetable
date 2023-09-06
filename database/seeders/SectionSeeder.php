<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // create one section against every Semester
         $semesters = Semester::all();
            foreach ($semesters as $semester) {
                $semester->sections()->create([
                    'name' => 'A',
                ]);
            }

        // for BBA and BSCS  Semesters 1 to 3  create two Sections and name them G1 and G2

$semesters = Semester::whereIn('name', ['Morning BBA 1', 'Morning BBA 2', 'Morning BBA 3', 'Evening BBA 1', 'Evening BBA 2', 'Evening BBA 3', 'Morning BSCS 1', 'Morning BSCS 2', 'Morning BSCS 3', 'Evening BSCS 1', 'Evening BSCS 2', 'Evening BSCS 3'])->get();

foreach ($semesters as $semester) {
    // Check if the semester is in Semesters 1 to 3
    if (in_array($semester->name, ['Morning BBA 1', 'Morning BBA 2', 'Morning BBA 3', 'Evening BBA 1', 'Evening BBA 2', 'Evening BBA 3', 'Morning BSCS 1', 'Morning BSCS 2', 'Morning BSCS 3', 'Evening BSCS 1', 'Evening BSCS 2', 'Evening BSCS 3'])) {
        $semester->sections()->create([
            'name' => 'G1',
        ]);
        $semester->sections()->create([
            'name' => 'G2',
        ]);
    } else {
        $semester->sections()->create([
            'name' => 'A',
        ]);
    }
}




    }
}
