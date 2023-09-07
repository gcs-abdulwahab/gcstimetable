<?php

use App\Http\Controllers\DayController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// write API Route for Day
Route::apiResource('days', DayController::class);

// write API Route for Department
Route::apiResource('departments', DepartmentController::class);

//write API for Program
Route::resource('programs', ProgramController::class);

//write API for Semester
Route::resource('semesters', SemesterController::class);

//write Api for Room\
Route::resource('rooms', RoomController::class);


//write Api for Teachers
Route::resource('teachers', TeacherController::class);