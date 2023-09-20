<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DayResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($day) {
            return [
                'id' => $day->id,
                'name' => $day->name,
                'number' => $day->number,
                'code' => $day->code,
            ];
        })->toArray();
    }
}
