<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAllocationRequest;
use App\Http\Resources\AllocationCollection;
use App\Models\Allocation;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $allocations = Allocation::all();
            $teacherId = 82;

            $filteredAllocations = $allocations->filter(function ($allocation) use ($teacherId) {
                return $allocation->teacher_id == $teacherId;
            });
            return new AllocationCollection($allocations); // 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error' . $exception->getMessage()], 500);
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
    public function store(Request $request)
    {

        // check if there is a duplicate entry against the $request data
        // if there is a duplicate entry, then check if the displaycode of the course is same
        // if the displaycode is same, then allow the entry
        // if the displaycode is not same, then throw an error
        // if there is no duplicate entry, then allow the entry

        Log::info($request->all());

        $allocation = DB::table('allocations')
            ->where('day_id', $request->day_id)
            ->where('slot_id', $request->slot_id)
            ->where('teacher_id', $request->teacher_id)
           
            ->where('room_id', $request->room_id)
            ->where('course_id', $request->course_id);

            $count = $allocation->count();
            
            if ($count == 0 )
                {
                    Log::info('count is 0   first time entry');            
                    Allocation::create($request->all());
                }
                else{
                    Log::info('count is not 0   duplicate entry  count is '.$count);
                    $course = Course::where('id', $request->course_id);
                  //  if ($course->display_code ==   )
                    }
/* 

        // get the displaycode of the course
        $displaycode = Course::where('id', $request->course_id)->first()->display_code;

        Log::info('displaycode ' . $displaycode);
 */

            // if validation fails, it will throw an exception
            // if validation passes, it will return the validated data
            

        // try {
        //     $allocation = Allocation::create($validated);
        //     return response()->json($allocation, 201); // 201 Created
        // } catch (QueryException $exception) {
        //     return response()->json(['error' => 'Constraint violation or other database error' . $exception->getMessage()], 422);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Allocation $allocation)
    {
        if (!$allocation) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
        return response()->json($allocation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allocation $allocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllocationRequest $request, Allocation $allocation)
    {
        try {
            $allocation->update($request->all());
            return response()->json($allocation, 200); // 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error' . $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allocation $allocation)
    {
        try {
            $allocation->delete();
            return response()->json(['allocation' => $allocation,  'message' => 'Resource successfully deleted'], 200);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error' . $exception->getMessage()], 500);
        }
    }
}
