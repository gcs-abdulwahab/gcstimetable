<?php

namespace Database\Seeders;

use App\Models\Allocation;
use Exception;
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

        $allocations = json_decode(file_get_contents(__DIR__.'/allocations.json'), true);

        foreach($allocations as $key => $allocation){
            Allocation::create($allocation);
        }
    }
}
