<?php

namespace Database\Seeders;

use App\Models\Room;
// import faker
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;




class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 50 rooms with random values  
        //Room::factory()->count(50)->create();

        // create Room with name R-1 and name as 1 of BS

/*   $table->string('name')->unique();
        
            // create a unique code for each room
            $table->string('code')->unique();
            $table->integer ('capacity');
            // create a column so it could be either Intermediate , BS or both   enum
            $table->enum('type', ['intermediate', 'bs','both']);
            // isavailable
            $table->boolean('isavailable');
             */

             $faker = Faker::create();

        $institution_id = 1;

        // create room with same pattern upto 200
        for ($i = 1; $i <= 200; $i++) {
            Room::create([
                'name' => 'R-' . $i,
                'code' => 'R-' . $i,
                'capacity' => 50,
                //type would be random
                'type' => $faker->randomElement(['intermediate', 'bs', 'both']),

                'isavailable' => true,
                'institution_id' => $institution_id
            ]);
        }



        $institution_id = 2;

        // create room with same pattern upto 200
        for ($i = 1; $i <= 200; $i++) {
            Room::create([
                'name' => 'R-' . $i,
                'code' => 'R-' . $i,
                'capacity' => 50,
                //type would be random
                'type' => $faker->randomElement(['intermediate', 'bs', 'both']),

                'isavailable' => true,
                'institution_id' => $institution_id
            ]);
        }




        
        
    }
}
