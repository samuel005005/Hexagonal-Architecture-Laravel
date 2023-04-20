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
        var_dump($this->resource->getId());die;
        return [
            'status' => 'success',
            'user' => [
                'id' => $this->resource->getId(),
            ]
        ];
    }
}

