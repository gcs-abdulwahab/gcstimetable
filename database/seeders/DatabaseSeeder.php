<?php

namespace Database\Seeders;

use App\RoleEnum;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        $superadmin_role        = Role::where('name', RoleEnum::SUPER_ADMIN)->first();
        $institute_admin_role   = Role::where('name', RoleEnum::INSTITUTE_ADMIN)->first();
        $department_admin_role  = Role::where('name', RoleEnum::DEPARTMENT_ADMIN)->first();

        // Institutions
        $this->call(InstitutionSeeder::class);

        // Super Admin
        $superAdmin = User::factory()
            ->create([
                'name' => 'superadmin',
                'email' => 'sadmin@gmail.com',
                'password' => 'asdf1234',
            ]);

        $superAdmin->assignRole($superadmin_role);

        // Institution Admin
        $firstInstitution = Institution::first();
        $institutionAdmin = User::factory()
            ->for($firstInstitution)
            ->create([
                'name' => 'iadmin',
                'email' => 'iadmin@gmail.com',
                'password' => 'asdf1234',
                'institution_id' => 1,
            ]);

        $institutionAdmin->assignRole($institute_admin_role);

        // Institution Admin
        $lastInstitution = Institution::latest()->first();
        $institutionAdmin2 = User::factory()
            ->for($lastInstitution)
            ->create([
                'name' => 'iadmin2',
                'email' => 'iadmin2@gmail.com',
                'password' => 'asdf1234',
                'institution_id' => 2,
            ]);

        $institutionAdmin2->assignRole($institute_admin_role);

        $this->call(DepartmentSeeder::class);

        // Department Admin
        $departmentAdmin = User::factory()
            ->for($lastInstitution)
            ->create([
                'name' => 'dadmin',
                'email' => 'dadmin@gmail.com',
                'password' => 'asdf1234',
                'department_id' => 1,
            ]);

        $departmentAdmin->assignRole($department_admin_role);

        // Department Admin
        $departmentAdmin = User::factory()
        ->for(Institution::latest()->first())
        ->create([
            'name' => 'dadmin2',
            'email' => 'dadmin2@gmail.com',
            'password' => 'asdf1234',
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

        $this->call(TimeTableSeeder::class);

        $this->call(AllocationSeeder::class);

        $this->call(StudentSeeder::class);

        $this->call(UserSeeder::class);
    }
}
