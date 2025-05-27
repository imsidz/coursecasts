<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
         'datetime' => $this->resource->toIso8601String(),
        'formatted' => $this->resource->format('M d, Y — H:i'),
    'human' => $this->resource->format('M d, Y'),
        ];
    }
}
