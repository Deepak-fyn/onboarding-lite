<?php

namespace App\Services;

use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AgentAuthService
{
    public function authenticate(
        string $email,
        string $password
    ): Agent {
        $agent = Agent::where('email', $email)->first();

        if (!$agent || !$agent->password) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.'],
            ]);
        }

        if (!Hash::check($password, $agent->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.'],
            ]);
        }

        return $agent;
    }

    public function createApiToken(Agent $agent): string
    {
        return $agent
            ->createToken('agent-api-token')
            ->plainTextToken;
    }


    public function logout(Agent $agent): void
{
    $agent->currentAccessToken()?->delete();
}


}