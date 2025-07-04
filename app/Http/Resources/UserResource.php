<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'profile' => $this->profile ? asset("storage/{$this->profile}") : null,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'address' => [
                'street' => $this->street,
                'neighborhood' => $this->neighborhood,
                'state' => $this->state,
            ],
            'biography' => $this->biography,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString()
        ];
    }
}