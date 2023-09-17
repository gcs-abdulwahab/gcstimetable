<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Program;
use Illuminate\Database\QueryException;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return all programs with proper exception handling just like DepartmentController
        try {
            return response()->json(Program::all()->sortByDesc('updated_at'), 200); // 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()  ], 500);
        }
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
    public function store(StoreProgramRequest $request)
    {
        // write store method like Department store method
        try{
            $program = Program::create($request->all());
            return response()->json($program, 201); // 201 Created
        }
        catch(QueryException $exception){
            return response()->json(['error' => 'Constraint violation or other database error'.$exception->getMessage()  ], 422);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        // write show method like Day show method
        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }
        return response()->json($program);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        // write update method like Day update method
        try {            
            $program->update($request->all());
            return response()->json($program, 200); // 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()  ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // write destroy method like Day destroy method
        try {
            $program->delete();
            return response()->json($program, 204); // 204 Successfully Deleted or 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()  ], 500);
        }
    }
}
