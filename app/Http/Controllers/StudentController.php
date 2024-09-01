<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Inertia\Inertia;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $dateFormat = config('providers.date.readable');
        $students = Student::select('id', 'name', 'email', 'mobile', 'created_at')
        ->get()
        ->transform(function ($user) use ($dateFormat) {
            $user->createdAt  = $user->created_at?->format($dateFormat);

            return $user;
        });

        return Inertia::render('Admin/Students', ['students' => $students]);
    }
}
