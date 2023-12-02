<?php


namespace App\Http\Controllers;

use App\Http\Requests\UpdateAllocationRequest;
use App\Http\Resources\AllocationCollection;
use App\Models\Allocation;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $allocations = Allocation::all();
            
            if($request->wantsJson()){
                return response()->json(new AllocationCollection($allocations));
            }else{
                return Inertia::render('AllocationForm', [
                    'allocations' => new AllocationCollection($allocations),
                ]);
            }

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
        //        $constraints = new Constraint();
        Log::channel("allocations")->info("CreateAllocation_Request", $request->all());

        $message = "";
        $status_code = 201;
        $allocation = null;
        try {

            $allocation = Allocation::create($request->all());
            $message = 'Resource successfully created';
        } catch (QueryException $exception) {
            $status_code =  422;
            $message = 'Constraint violation or other database error ' . $exception->getMessage();
        } catch (Exception $exception) {
            $status_code =  400;
            $message = 'Constraint violation or other database error ' . $exception->getMessage();
        }

        Log::channel("allocations")->info($message);
        $data = [
            'allocation' => $allocation,
            'message' => $message,
            'status' => $status_code
        ];

        if($request->wantsJson()){
            return response()->json($data, $status_code);
        }

        return Inertia::render("AllocationForm/Create", 
                [
                    'allocation' => $allocation, 
                    'message' => $message, 
                    'status' => $status_code
                ]
            );
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
