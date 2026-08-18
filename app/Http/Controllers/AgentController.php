<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Services\AgentService;
use Illuminate\Http\RedirectResponse;
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
}