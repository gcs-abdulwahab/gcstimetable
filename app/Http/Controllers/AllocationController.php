<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Slot;
use App\Models\TimeTable;
use Exception;
use Inertia\Inertia;
use App\Models\Allocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Resources\AllocationCollection;
use App\Http\Requests\StoreAllocationRequest;
use App\Http\Requests\UpdateAllocationRequest;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $allocations = Allocation::all();

            if ($request->wantsJson()) {
                return response()->json(new AllocationCollection($allocations));
            } else {
                return Inertia::render('AllocationForm', [
                    'allocations' => new AllocationCollection($allocations),
                ]);
            }

        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'slot_id'          => 'required',
            'time_table_id'     => 'required'
        ]);

        $timetable = TimeTable::whereKey($request->time_table_id)->with('shift.institution.days')->first();
        $slot      = Slot::find($request->slot_id);
        $sections  = Section::whereHas('semester.program.shift', function ($query) use ($timetable) {
            $query->where('shift_id', $timetable->shift_id);
        })->get();

        return Inertia::render('Admin/Allocations/create', [
            'props' => [
                'timetable' => $timetable,
                'slot' => $slot,
                'sections' => $sections,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::channel('allocations')->info('CreateAllocation_Request', $request->all());

        $message    = '';
        $allocation = null;
        try {

            $allocation = Allocation::create($request->all());

            return back()->with('allocation', $allocation);

        } catch (QueryException $exception) {
            $message = 'Constraint violation or other database error '.$exception->getMessage();
        } catch (Exception $exception) {
            $message = 'Constraint violation or other database error '.$exception->getMessage();
        }

        Log::channel('allocations')->info($message);

        return back()->withErrors(['message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Allocation $allocation)
    {
        if (! $allocation) {
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
            return response()->json(['error' => 'Database error'.$exception->getMessage()], 500);
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
            return response()->json(['error' => 'Database error'.$exception->getMessage()], 500);
        }
    }
}
