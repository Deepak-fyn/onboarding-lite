<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\AgentService;
use Illuminate\Http\RedirectResponse;

class AgentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Agent::with('kyc');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agents = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.agents.index', compact('agents'));
    }

    public function approve(
    Agent $agent,
    AgentService $agentService
): RedirectResponse {

    try {

        $agentService->approve($agent);

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent approved successfully.');

    } catch (\DomainException $e) {

        return redirect()
            ->route('admin.agents.index')
            ->with('error', $e->getMessage());
    }
}

public function reject(
    Agent $agent,
    AgentService $agentService
): RedirectResponse {

    try {

        $agentService->reject($agent);

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent rejected successfully.');

    } catch (\DomainException $e) {

        return redirect()
            ->route('admin.agents.index')
            ->with('error', $e->getMessage());
    }
}
}