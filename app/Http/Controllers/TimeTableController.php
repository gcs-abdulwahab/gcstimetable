<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Shift;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TimeTable\StoreTimeTableRequest;
use App\Http\Requests\TimeTable\UpdateTimeTableRequest;

class TimeTableController extends Controller
{
    public function index()
    {
        $tables = TimeTable::take(5)->get();

        return Inertia::render('Admin/TimeTables/index', [
            'timeTables' => $tables
        ]);
    }

    public function create()
    {
        $shifts = Shift::all();
        return Inertia::render('Admin/TimeTables/create', [
            'shifts' => $shifts
        ]);
    }

    public function store(StoreTimeTableRequest $request)
    {
        $attributes = $request->validated();

        $response = Gate::inspect('create', TimeTable::class);

        if ($response->allowed()) {

            TimeTable::create($attributes);

            return back()->with('success', 'Time Table created successfully.');
        }

        return back()->withErrors(['message' => $response->message()]);
    }

    public function edit(TimeTable $timetable)
    {
        $timetable->load('shift');
        $shifts = Shift::all();

        return Inertia::render('Admin/TimeTables/edit', [
            'timetable' => $timetable,
            'shifts' => $shifts
        ]);
    }

    public function update(UpdateTimeTableRequest $request, TimeTable $timetable)
    {
        $attributes = $request->validated();

        $response = Gate::inspect('update', $timetable);

        if ($response->allowed()) {

            $timetable->update($attributes);

            return back()->with('success', 'Time Table updated successfully.');
        }

        return back()->withErrors(['message' => $response->message()]);
    }
}
