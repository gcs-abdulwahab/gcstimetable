<?php

use App\Http\Controllers\AllocationController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\RoleOrPermissionMiddleware;
use App\PermissionEnum;
use App\RoleEnum;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TimeTableController;

/*
    |----------------Resource Controllers----------------|
    Route::resource('photos', Controller::class);

    Verb	        URI	                    Action	Route Name
    GET	            /photos	                index	photos.index
    GET	            /photos/create	        create	photos.create
    POST	        /photos	                store	photos.store
    GET	            /photos/{photo}	        show	photos.show
    GET	            /photos/{photo}/edit	edit	photos.edit
    PUT/PATCH	    /photos/{photo}	        update	photos.update
    DELETE	        /photos/{photo}	        destroy	photos.destroy
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Routes 🔒
    Route::prefix('admin')
        ->middleware(RoleOrPermissionMiddleware::class)
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Users 🧑‍🤝‍🧑
            Route::prefix('users')->group(function () {
                Route::get('', [UserController::class, 'index'])->name('users.index');
                Route::post('', [UserController::class, 'create'])->name('users.create');
                Route::delete('/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');
            });

            // Students 🧑‍🎓
            Route::get('/students', [StudentController::class, 'index'])->name('students.index');

            // Teachers 🧑‍🏫
            Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

            // Time Table Resource 📆
            Route::resource('timetables', TimeTableController::class);
            Route::get('/timetables/{timetable}/add/allocations', [TimeTableController::class, 'addAllocations'])->name('timetables.add.allocations');

            // Allocations 🔹
            Route::resource('allocations', AllocationController::class);

            // Rooms 🏫
            Route::resource('rooms', RoomController::class);
        });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
