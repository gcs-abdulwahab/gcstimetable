<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h1>{{ $shift['id'] . " - " . $shift['name'] }}</h1>

    <table class="min-w-full border-collapse">
        <thead>
        <tr>
            <th class="border border-gray-400 px-4 py-2">--</th>
            @foreach($slots as $slot)
            <th
                wire:key="{{ $slot->id }}"
                class="border border-gray-400 px-4 py-2"
            >
                {{$slot->name}}
            </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @if(isset($sessions))
            @foreach($sessions as $session)
                => (
                <tr wire:key="{{$session->id}}">
                    <td class="border border-gray-400 px-4 py-2 font-bold">
                        {{$session->name}}
                    </td>
                    {{--            {slots.map((slot, colIndex) => (--}}
                    {{--            <td wire:key={colIndex} class="border border-gray-400 px-4 py-2">--}}
                    {{--                {/* Data for {session.name} in {slot.name} */}--}}
                    {{--            </td>--}}
                    {{--            ))}--}}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
