<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IPResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'ip_address'  => $this->ip_address,
            'status'      => $this->status,
            'ip_type'     => $this->ip_type,
            'remarks'     => $this->remarks,
            'created_at'  => $this->created_at->format('d M Y h:i A'),
            'updated_at'  => $this->updated_at->format('d M Y h:i A'),
        ];
    }
}
