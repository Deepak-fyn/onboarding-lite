<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Services\AgentAuthService;
use App\Services\AgentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AgentController extends Controller
{
    public function create(): View
    {
        return view('agents.register');
    }

    public function store(
        StoreAgentRequest $request,
        AgentService $agentService
    ): RedirectResponse {

        $agentService->register(
            $request->validated()
        );

        return redirect()
            ->route('agents.create')
            ->with('success', 'Agent registered successfully.');
    }

        public function webLogin(
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

    Auth::guard('web')->login($agent);

    $request->session()->regenerate();

    return response()->json([
        'success' => true,
        'message' => 'Web login successful.',
        'data' => [
            'agent' => $agent,
        ],
    ]);
}

}
