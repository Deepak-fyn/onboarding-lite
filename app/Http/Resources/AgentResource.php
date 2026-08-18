<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
            'status' => $this->status,
            'kyc' => [
                'pan_number' => $this->kyc?->pan_number,
                'aadhar_number' => $this->kyc?->aadhar_number,
            ],
            'created_at' => $this->created_at,
        ];
    }
}