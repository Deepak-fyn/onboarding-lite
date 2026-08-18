<?php

namespace App\Services;

use App\Models\Agent;
use Illuminate\Support\Facades\DB;

class AgentService
{
    public function register(array $data): Agent
    {
        return DB::transaction(function () use ($data) {

            $agent = Agent::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'date_of_birth' => $data['date_of_birth'],
                'status' => 'pending',
            ]);

            $agent->kyc()->create([
                'pan_number' => $data['pan_number'],
                'aadhar_number' => $data['aadhar_number'],
            ]);

            return $agent;
        });
    }

    public function approve(Agent $agent): Agent
{
    if ($agent->status !== 'pending') {
        throw new \DomainException(
            'Only pending agents can be approved.'
        );
    }

    $agent->update([
        'status' => 'approved',
    ]);

    return $agent->fresh();
}

public function reject(Agent $agent): Agent
{
    if ($agent->status !== 'pending') {
        throw new \DomainException(
            'Only pending agents can be rejected.'
        );
    }

    $agent->update([
        'status' => 'rejected',
    ]);

    return $agent->fresh();
}


}