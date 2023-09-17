<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Database\QueryException;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return all rooms with proper exception handling just like DepartmentController
        try {
            return response()->json(Room::all()->sortByDesc('updated_at'), 200); // 200 OK
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
    public function store(StoreRoomRequest $request)
    {
       // write store method like Department store method
         try{
          $room = Room::create($request->all());
          return response()->json($room, 201); // 201 Created
         }
         catch(QueryException $exception){
          return response()->json(['error' => 'Constraint violation or other database error'.$exception->getMessage()  ], 422);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        // write show method like Day show method
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }
        return new RoomResource($room);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //write update method like Day update method
        try {
            $room->update($request->all());
            return response()->json($room, 200); // 200 OK
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error' . $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return response()->json([ 'room'=>$room,  'message' => 'Resource successfully deleted'], 200);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Database error'.$exception->getMessage()  ], 500);
        }
    }
}
