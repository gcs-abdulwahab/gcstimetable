<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 6  slots  such that each slot is 1 hour apart
        // first slot  starts at 8:00 am and ends at 9:00 am
        // second slot starts at 9:00 am and ends at 10:00 am
        // third slot  starts at 10:00 am and ends at 11:00 am
        // fourth slot starts at 11:00 am and ends at 12:00 pm
        // fifth slot  starts at 12:00 pm and ends at 1:00 pm
        // sixth slot  starts at 1:00 pm and ends at 2:00 pm
        \App\Models\Slot::factory()->count(6)->create([
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
        ]);
        \App\Models\Slot::factory()->count(6)->create([
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
        ]);
        \App\Models\Slot::factory()->count(6)->create([
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);
        \App\Models\Slot::factory()->count(6)->create([
            'start_time' => '11:00:00',
            'end_time' => '12:00:00',
        ]);
        \App\Models\Slot::factory()->count(6)->create([
            'start_time' => '12:00:00',
            'end_time' => '13:00:00',
        ]);
        \App\Models\Slot::factory()->count(6)->create([
            'start_time' => '13:00:00',
            'end_time' => '14:00:00',
        ]);


    }
}
