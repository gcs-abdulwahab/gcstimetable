<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        Log::info('RoomResource:toArray');

        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'code' => $this->code,
            // 'capacity' => $this->capacity,
            // 'type' => $this->type,
            // 'is_available' => $this->isavailable

        ];
    }
}
