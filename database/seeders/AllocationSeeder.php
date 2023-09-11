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
    }
}
