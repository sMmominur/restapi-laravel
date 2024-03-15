<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'slug'         => $this->slug,
            'status'       => $this->status,
            'description'  => $this->description,
            'created_at'   => $this->created_at->format('d M Y h:i A'),
            'updated_at'   => $this->updated_at->format('d M Y h:i A'),
        ];
    }
}
