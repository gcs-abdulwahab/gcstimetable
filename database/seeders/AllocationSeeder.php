<?php

namespace Database\Seeders;

use App\Models\Allocation;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* 
            // foreign key to course
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            // foreign key to teacher
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            // foreign key to room
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            // foreign key to day
            $table->foreignId('day_id')->constrained()->onDelete('cascade');
            // foreign key to slot
            $table->foreignId('slot_id')->constrained()->onDelete('cascade');
 */

        
            try{
                // create  allocations
            Allocation::factory()->count(450)->create();
            
            }
            catch(QueryException $e){
                // write the error to the console
                echo $e->getMessage();


            }






    }
}
