<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
