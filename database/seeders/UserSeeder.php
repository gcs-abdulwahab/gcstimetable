<?php

namespace Database\Seeders;

use App\RoleEnum;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(100)
            ->hasAttached(Role::whereIn('name', [RoleEnum::STUDENT, RoleEnum::TEACHER])->inRandomOrder()->first())
            ->for(Institution::inRandomOrder()->first())
            ->create();
    }
}
