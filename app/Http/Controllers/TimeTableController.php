<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Inertia\Inertia;
use App\Models\Shift;
use App\Models\Section;
use App\Models\TimeTable;
use App\Models\Allocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TimeTable\StoreTimeTableRequest;
use App\Http\Requests\TimeTable\UpdateTimeTableRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function addAllocations(TimeTable $timetable)
    {
        $timetable->load(['shift.slots', 'allocations']);
        $sections    = [];

        if ($timetable->allocations) {
            $sectionIds = $timetable->allocations?->groupby('section_id')->keys();

            if ($sectionIds && count($sectionIds) > 0) {
                // Getting Table Sections
                $sections = Section::whereIn('id', $sectionIds)->with(['semester' => function ($query) {
                    $query->select('id', 'name', 'number');
                }])->get();

            }
        }

        return Inertia::render('Admin/TimeTables/addAllocations', [
            'timetable' => $timetable,
            'sections' => $sections
        ]);
    }
}
