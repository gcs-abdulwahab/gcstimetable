<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Shift;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Allocation extends Component implements HasForms
{
    use InteractsWithForms;

    public array $shift;
    public array $program;
    public array $semester;
    public Shift|Collection $shiftModel;
    public Program|Collection $programModel;
    public Semester|Collection $semesterModel;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $courses = [];
        if (isset($this->semester['id'])) {
            $courses = Course::query()->where('semester_id', $this->semester['id'])->pluck('name', 'id');
        }
        return $form
            ->schema([
                Select::make('Courses')
                    ->options($courses)
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('Shift')
                    ->required(),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $shifts = $this->shiftModel ?? Shift::all();
        if (!isset($this->shift)) {
            $this->filterShifts($shifts->first()->toArray());
        }

        return view('livewire.allocation')
            ->with([
                'shifts' => $shifts,
                'semesters' => $this->semesterModel ?? Semester::all(),
                'programs' => $this->programModel,
            ]);
    }

    public function filterShifts($shift): void
    {
        $this->shift = $shift;
        $programs = Program::query()->where('shift_id', $shift['id'])->get();
        if ($programs && count($programs) > 0) {
            $this->programModel = $programs;
            $this->program = $programs->first()->toArray();
            $this->semesterModel = Semester::query()
                ->whereIn('program_id', [$this->program['id']])
                ->get();
            if ($this->semesterModel->count() > 0) {
                $this->semester = $this->semesterModel->first()->toArray();
            }
        }
    }

    public function filterThroughProgram($program): void
    {
        $this->program = $program;
        $this->semesterModel = Semester::query()
            ->whereIn('program_id', [$this->program['id']])
            ->get();

        if ($this->semesterModel->count() > 0) {
            $this->semester = $this->semesterModel->first()->toArray();
        }
    }

    public function filterThroughSemester($semester): void
    {
        $this->semester = $semester;
    }

    public function getSemesterNumber(int $number): string
    {
        return match ($number) {
            1 => '1st',
            2 => '2nd',
            3 => '3rd',
            4 => '4th',
            5 => '5th',
            6 => '6th',
            7 => '7th',
            8 => '8th',
        };
    }
}
