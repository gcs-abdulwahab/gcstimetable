<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Teacher;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('department.institution')
            ->get()
            ->transform(function ($teacher) {
                $teacher->dob                     = $teacher->date_of_birth?->format(config('providers.date.format'));
                $teacher->collegeJoiningDate      = $teacher->date_of_joining_in_this_college?->format(config('providers.date.format'));
                $teacher->govtServiceJoiningDate  = $teacher->date_of_joining_govt_service?->format(config('providers.date.format'));
                $teacher->currentRankJoiningDate  = $teacher->date_of_joining_current_rank?->format(config('providers.date.format'));
                $teacher->registrationDate        = $teacher->created_at?->format(config('providers.date.readable'));

                return $teacher;
            });

        return Inertia::render('Admin/Teachers/index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = Teacher::create($request->all());

            return response()->json($teacher, 201); // 201 Created
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Constraint violation or other database error'.$exception->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        if (! $teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            $teacher->update($request->all());

            return response()->json($teacher, 200); // 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();

            return response()->json(['teacher' => $teacher,  'message' => 'Resource successfully deleted'], 200);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()], 500);
        }
    }
}
