<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            [
                'id' =>1,
                'name' => 'Morning Inter',
                'comments' => 'Morning Inter',
                'institution_id' => 1,
            ],
            [
                'id' =>2,
                'name' => 'Morning BS',
                'comments' => 'Morning BS',
                'institution_id' => 1,
            ],
            [
                'id' =>3,
                'name' => 'Evening BS',
                'comments' => 'Evening BS',
                'institution_id' => 1,
            ],
            [
                'id' =>4,
                'name' => 'Evening Inter',
                'comments' => 'Evening Inter',
                'institution_id' => 1,
            ],
        ];

        foreach ($shifts as $shift) {
            Shift::create($shift);
        }

    }
}
