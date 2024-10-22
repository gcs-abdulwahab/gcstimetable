<?php

namespace Database\Seeders;

use Exception;
use App\Models\Allocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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
