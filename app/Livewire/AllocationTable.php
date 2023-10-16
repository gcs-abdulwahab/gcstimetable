<?php

namespace App\Livewire;

use App\Models\Section;
use App\Models\Slot;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class AllocationTable extends Component
{
    #[Reactive]
    public array $shift;
    #[Reactive]
    public array $semester;


    public Slot|Collection $slots;
    public Section|Collection $sections;

    public function mount(): void
    {
        $this->slots = Slot::query()->where('shift_id', $this->shift['id'])->get();
        if ($this->semester && count($this->semester) > 0) {
            $this->sections = Section::query()->where('semester_id', $this->semester['id'])->get();
        }

    }

    public function render(): view
    {
        return view('livewire.allocation-table');
    }
}
