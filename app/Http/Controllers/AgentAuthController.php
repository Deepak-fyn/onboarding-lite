<?php

namespace App\Http\Controllers;

use App\Services\AgentAuthService;
use Illuminate\Http\Request;

class AgentAuthController extends Controller
{
    public function login(
        Request $request,
        AgentAuthService $authService
    ) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $agent = $authService->authenticate(
            $request->email,
            $request->password
        );

        $token = $authService->createApiToken($agent);

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'agent' => $agent,
                'token' => $token,
            ],
        ]);
    }

    public function logout(
        Request $request,
        AgentAuthService $authService
    ) {
        $authService->logout($request->user());

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ]);
    }

}