<div>
    <div class="space-y-4">
        {{-- Shifts of the Instituion --}}
        <div class="flex flex-wrap gap-2">
            <h1 class="flex w-full text-xl font-bold">Shifts</h1>
            @foreach($shifts as $shift)
            <button wire:key="{{ $shift->id }}" wire:click="filterShifts({{ $shift }})" class="px-2 py-1 rounded text-md text-custom-500 {{ ($this->shift->id === $shift->id) ? 'bg-primary-500 text-custom-500' : 'bg-custom-500 border border-primary-500' }}">{{ $shift->name }}</button>
            @endforeach
        </div>

        {{-- Programs of the Institution --}}
        <div class="flex flex-wrap gap-2">
            <h1 class="flex w-full text-xl font-bold">Programs</h1>
            @foreach($programs as $program)
            <button wire:key="{{ $program->id }}" wire:click="filterThroughProgram({{ $program }})" class="px-2 py-1 rounded text-md text-custom-500 {{ ($this->program->id === $program->id) ? 'bg-primary-500 text-custom-500' : 'bg-custom-500 border border-primary-500' }}">{{ $program->name }}</button>
            @endforeach
        </div>

        {{-- Semester of the Institution --}}
        @if(isset($this->semester) && count($semesters) > 0)
        <div class="flex flex-wrap gap-2">
            <h1 class="flex w-full text-xl font-bold">Semesters</h1>
            @foreach($semesters as $semester )
            <button wire:key="{{ $semester->id }}" wire:modal.live="semester" class="px-2 py-1 rounded {{ ($this->semester->id === $semester->id) ? 'bg-primary-500 text-custom-500' : 'bg-custom-500 border border-primary-500' }}">{{ $this->getSemesterNumber($semester->number)  }}</button>
            @endforeach
        </div>
        @endif

        {{-- Table Form the fill Allocation--}}
        <div>
            <form wire:submit="create">
                {{ $this->form }}
                <div>
                    <br />
                    <div class="flex justify-end border-white">
                        <button type="submit" class="px-2 py-1 rounded bg-primary-600">
                            Submit
                        </button>
                    </div>
                </div>
            </form>

            <x-filament-actions::modals />
        </div>

    </div>
</div>