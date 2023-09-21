<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAllocationRequest;
use App\Http\Requests\UpdateAllocationRequest;
use App\Http\Resources\AllocationCollection;
use App\Models\Allocation;
use Illuminate\Database\QueryException;

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
    public function store(StoreAllocationRequest $request)
    {
        try {
            $allocation = Allocation::create($request->all());
            return response()->json($allocation, 201); // 201 Created
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Constraint violation or other database error' . $exception->getMessage()], 422);
        }
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
