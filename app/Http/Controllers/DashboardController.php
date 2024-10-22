<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Scopes\InstitutionScope;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\DepartmentScope;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        $userCount = User::query()
            ->when($admin->isInstitutionAdmin(), function ($query) use ($admin) {
                $query->whereInstitution($admin->institution_id);
            })
            ->when($admin->isDepartmentAdmin(), function ($query) use ($admin) {
                $query->whereDepartment($admin->department_id);
            })
            ->count();

        $statistics = [
            'users'     => $userCount,
            'students'  => Student::count(),
            'teachers'  => Teacher::count(),
        ];

        return Inertia::render('Dashboard', [
            'statistics' => $statistics,
        ]);
    }
}
