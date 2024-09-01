<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin_role = Role::create(['name' => 'sadmin']);
        $institute_admin_role = Role::create(['name' => 'iadmin']);
        $department_admin_role = Role::create(['name' => 'dadmin']);

        // Super Admin
        $superAdmin = User::factory()
            ->create([
                'name' => 'superadmin',
                'email' => 'sadmin@gmail.com',
                'password' => bcrypt('sadmin@gmail.com'),
            ]);

        $superAdmin->assignRole($superadmin_role);

        $this->call(InstitutionSeeder::class);

        // Institution Admin
        $institutionAdmin = User::factory()
            ->create([
                'name' => 'iadmin',
                'email' => 'iadmin@gmail.com',
                'password' => bcrypt('iadmin@gmail.com'),
                'institution_id' => 1,
            ]);

        $institutionAdmin->assignRole($institute_admin_role);

        // Institution Admin
        $institutionAdmin2 = User::factory()
            ->create([
                'name' => 'IAdmin',
                'email' => 'iadmin2@gmail.com',
                'password' => bcrypt('iadmin2@gmail.com'),
                'institution_id' => 2,
            ]);

        $institutionAdmin2->assignRole($institute_admin_role);

        $this->call(DepartmentSeeder::class);

        // Department Admin
        $departmentAdmin = User::factory()
            ->create([
                'name' => 'dadmin',
                'email' => 'dadmin@gmail.com',
                'password' => bcrypt('dadmin@gmail.com'),
                'department_id' => 1,
            ]);

        $departmentAdmin->assignRole($department_admin_role);

        $this->call(ShiftSeeder::class);

        $this->call(RoomSeeder::class);

        $this->call(SlotSeeder::class);

        $this->call(DaySeeder::class);

        $this->call(ProgramSeeder::class);

        $this->call(TeacherSeeder::class);

        $this->call(SemesterSeeder::class);

        $this->call(SectionSeeder::class);

        $this->call(CourseSeeder::class);

        $this->call(AllocationSeeder::class);

        $this->call(StudentSeeder::class);

        $this->call(UserSeeder::class);
    }
}
