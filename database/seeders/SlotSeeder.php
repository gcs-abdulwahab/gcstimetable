<?php

namespace Database\Seeders;

use App\Models\Slot;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of slot data
        $slots = [
            ['name' => '8-9', 'code' => 'p1', 'start_time' => '08:00:00', 'end_time' => '09:00:00'],
            ['name' => '9-10', 'code' => 'p2', 'start_time' => '09:00:00', 'end_time' => '10:00:00'],
            ['name' => '10-11', 'code' => 'p3', 'start_time' => '10:00:00', 'end_time' => '11:00:00'],
            ['name' => '11-12', 'code' => 'p4', 'start_time' => '11:00:00', 'end_time' => '12:00:00'],
            ['name' => '12-1', 'code' => 'p5', 'start_time' => '12:00:00', 'end_time' => '13:00:00'],
        ];

        $insitution_id = 1;
        // Create records for slots using the array
        foreach ($slots as $slotData) {
            $slotData['institution_id'] = $insitution_id;
            Slot::create($slotData);
        }

        $insitution_id = 2;
        // Create records for slots using the array
        foreach ($slots as $slotData) {
            $slotData['institution_id'] = $insitution_id;
            Slot::create($slotData);
        }

    }
}
