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
        $slotsMorning = [
            ['name' => '8:00-9:00', 'code' => 'p1', 'start_time' => '08:00:00', 'end_time' => '09:00:00'],
            ['name' => '9:00-10:00', 'code' => 'p2', 'start_time' => '09:00:00', 'end_time' => '10:00:00'],
            ['name' => '10:00-11:00', 'code' => 'p3', 'start_time' => '10:00:00', 'end_time' => '11:00:00'],
            ['name' => '11:00-12:00', 'code' => 'p4', 'start_time' => '11:15:00', 'end_time' => '12:15:00'],
            ['name' => '12:15-1:15',  'code' => 'p5', 'start_time' => '12:15:00', 'end_time' => '13:15:00'],
            ['name' => '1:30-2:30',   'code' => 'p6', 'start_time' => '13:30:00', 'end_time' => '14:30:00'],
            ['name' => '2:30-3:30',   'code' => 'p7', 'start_time' => '14:30:00', 'end_time' => '15:30:00'],
            ['name' => '3:30-4:30',   'code' => 'p8', 'start_time' => '15:30:00', 'end_time' => '16:30:00'],


        ];

        $insitution_id = 1;
        // Create records for slotsMorning$slotsMorning using the array
        foreach ($slotsMorning as $slotData) {
            $slotData['institution_id'] = $insitution_id;
            Slot::create($slotData);
        }

        $insitution_id = 2;
        // Create records for slotsMorning$slotsMorning using the array
        foreach ($slotsMorning as $slotData) {
            $slotData['institution_id'] = $insitution_id;
            Slot::create($slotData);
        }

        // Define an array of slot data
        $slotEvening = [
            ['name' => '11:10-12:30', 'code' => 'practical', 'start_time' => '11:10', 'end_time' => '12:30', 'is_practical' => true , 'is_morning'=>false],
            ['name' => '1:30-2:10', 'code' => 'p2', 'start_time' => '13:30', 'end_time' => '14:10' , 'is_morning'=>false],
            ['name' => '2:10-2:50', 'code' => 'p3', 'start_time' => '14:10', 'end_time' => '14:50' , 'is_morning'=>false],
            ['name' => '2:50-3:30', 'code' => 'p4', 'start_time' => '14:50', 'end_time' => '15:30' , 'is_morning'=>false],
            ['name' => '3:30-4:10', 'code' => 'p5', 'start_time' => '15:30', 'end_time' => '16:10' , 'is_morning'=>false],
            ['name' => '4:10-4:50', 'code' => 'p6', 'start_time' => '16:10', 'end_time' => '16:50' , 'is_morning'=>false],
            ['name' => '4:50-5:30', 'code' => 'p7', 'start_time' => '16:50', 'end_time' => '17:30' , 'is_morning'=>false],

        ];

        $insitution_id = 1;

        foreach ($slotEvening as $slotData) {
            $slotData['institution_id'] = $insitution_id;
            Slot::create($slotData);
        }

        $insitution_id = 2;
        // Create records for slotsMorning$slotEvening using the array
        foreach ($slotEvening as $slotData) {
            $slotData['institution_id'] = $insitution_id;
            Slot::create($slotData);
        }



    }
}
