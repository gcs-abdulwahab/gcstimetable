<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $superadmin_role = Role::create(['name' => 'sadmin']);
        $institute_admin_role = Role::create(['name' => 'iadmin']);
        $department_admin_role = Role::create(['name' => 'dadmin']);




        // call seeder of user Superadmin
        User::factory()->create([
            'name' => 'superadmin',
            'email' => 'sadmin@gmail.com',
            'password' => bcrypt('sadmin@gmail.com'),

        ])->assignRole($superadmin_role);


         // call seeder of institution
        $this->call(InstitutionSeeder::class);


        // call seeder of user Institution Admin
        User::factory()->create([
            'name' => 'iadmin',
            'email' => 'iadmin@gmail.com',
            'password' => bcrypt('iadmin@gmail.com'),
        ])->assignRole($institute_admin_role)  ;

        // call seeder of user Department Admin
        User::factory()->create([
            'name' => 'dadmin',
            'email' => 'dadmin@gmail.com',
            'password' => bcrypt('dadmin@gmail.com'),
            ])->assignRole($department_admin_role);

        $this->call(ShiftSeeder::class);

        // call seeder of room
        $this->call(RoomSeeder::class);
        // call seeder of department
        $this->call(DepartmentSeeder::class);
        // // call seeder of slot
        $this->call(SlotSeeder::class);
        // call seeder of day
        $this->call(DaySeeder::class);
        // call ProgramSeeder
        $this->call(ProgramSeeder::class);
        // call TeacherSeeder
        $this->call(TeacherSeeder::class);
        // call SemesterSeeder
        $this->call(SemesterSeeder::class);
        // call SectionSeeder
        $this->call(SectionSeeder::class);




        // call Course Seeder
        $this->call(CourseSeeder::class);


        // call AllocationSeeder
        $this->call(AllocationSeeder::class);

        // call StudentSeeder
        $this->call(StudentSeeder::class);

    }
}
