<?php

namespace App\Http\Controllers;

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
        $statistics = [
            'users'     => User::count(),
            'students'  => Student::count(),
            'teachers'  => Teacher::count(),
        ];
        
        return Inertia::render('Dashboard', [
            'statistics' => $statistics,
        ]);
    }
}
