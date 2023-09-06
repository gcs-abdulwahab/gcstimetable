<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 50 rooms with random values  
        \App\Models\Room::factory()->count(50)->create();
        
    }
}
