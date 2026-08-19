<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    public function updateAgentRole(Request $request, Agent $agent)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $agent->syncRoles([$request->role]);

        return response()->json([
            'success' => true,
            'message' => 'Agent role updated successfully.',
            'data' => [
                'agent_id' => $agent->id,
                'role' => $agent->getRoleNames()->first(),
            ],
        ]);
    }
}