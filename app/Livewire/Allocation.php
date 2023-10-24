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

    public Shift|Collection $shift, $shifts;
    public Program|Collection  $program, $programs;
    public Semester|Collection $semester, $semesters;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $courses = [];
        if (isset($this->semester, $this->semester->id)) {
            $courses = Course::query()->where('semester_id', $this->semester->id)->pluck('name', 'id');
        }
        return $form
            ->schema([
                Select::make('Courses')
                    ->options($courses)
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
        $this->shifts = Shift::all();
        if (!isset($this->shift)) {
            $this->filterShifts($this->shifts->first()->toArray());
        }

        return view('livewire.allocation')
            ->with([
                'shifts' => $this->shifts,
                'semesters' => $this->semesters ?? Semester::all(),
                'programs' => $this->programs,
            ]);
    }

    public function filterShifts($shift): void
    {
        $this->shift = Shift::query()->find($shift['id']);
        if ($this->shift) {
            
            $programs = Program::query()->where('shift_id', $this->shift->id)->get();
            if ($programs && count($programs) > 0) {

                $this->programs = $programs;
                $this->program = $programs->first();
                $this->semesters = Semester::query()
                    ->whereIn('program_id', [$this->program->id])
                    ->get();

                if ($this->semesters && $this->semesters->count() > 0) {
                    $this->semester = $this->semesters->first();
                }
            }
        }
    }

    public function filterThroughProgram($program): void
    {
        $this->program = Program::query()->find($program['id']);
        if($this->program){

            $this->semesters = Semester::query()
                ->whereIn('program_id', [$this->program->id])
                ->get();
    
            if ($this->semesters && $this->semesters->count() > 0) {
                $this->semester = $this->semesters->first();
            }
        }
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
