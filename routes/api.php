<?php

use App\Http\Controllers\AllocationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;





//write API Route for Institution
Route::apiResource('institutions', InstitutionController::class);

// write API Route for Day
Route::apiResource('days', DayController::class);


// write API Route for Department
Route::apiResource('departments', DepartmentController::class);

//write API for Program
Route::resource('programs', ProgramController::class);

//write API for Section
Route::resource('sections', SectionController::class);


//write API for Semester
Route::resource('semesters', SemesterController::class);

//write Api for Room\
Route::resource('rooms', RoomController::class);


//write Api for Teachers
Route::resource('teachers', TeacherController::class);

// write Api for Slots
Route::resource('slots',SlotController::class);

// write Api for Courses
Route::resource('courses',CourseController::class);

// write api for Allocations
Route::resource('allocations',AllocationController::class);
