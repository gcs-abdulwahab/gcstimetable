<?php

namespace Database\Seeders;

use App\Models\Allocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Allocation::truncate();

        // Specify the number of allocations you want to create
        $totalAllocations = 450;

        for ($i = 1; $i <= $totalAllocations; $i++) {
            try {
                // Attempt to create an allocation using the factory
                Allocation::factory()->create();
            } catch (\Exception $e) {
                // Handle any exceptions that occur during allocation creation
                // This could include database constraint violations or other errors

                // You can log the error, display a message, or take any other desired actions

                // For example, log the error message:
                Log::error('Error creating allocation: ' . $e->getMessage());
            }

        }

            /* // foreign key to course
            'course_id' => Course::all()->random()->id,
            // foreign key to teacher
            'teacher_id' => Teacher::all()->random()->id,
            // foreign key to room
            'room_id' =>  Room::all()->random()->id,
            // foreign key to day
            'day_id' =>  Day::all()->random()->id,
            // foreign key to slot
            'slot_id' =>   Slot::all()->random()->id,
            // foreign key to slot
            'section_id' =>   Section::all()->random()->id, */

            
            // create allocation for course_id = 1
            $allocation = new Allocation();
            $allocation->course_id = 1;
            $allocation->teacher_id = 1;
            $allocation->room_id = 1;
            $allocation->day_id = 1;
            $allocation->slot_id = 1;
            $allocation->section_id = 1;
            $allocation->save();


            $allocation = new Allocation();
            $allocation->course_id = 4;
            $allocation->teacher_id = 4;
            $allocation->room_id = 4;
            $allocation->day_id = 4;
            $allocation->slot_id = 4;
            $allocation->section_id = 4;
            $allocation->save();





            

    }
}
