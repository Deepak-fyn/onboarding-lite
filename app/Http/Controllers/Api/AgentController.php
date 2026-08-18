<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Resources\AgentResource;
use App\Services\AgentService;
use Illuminate\Http\JsonResponse;

class AgentController extends Controller
{
    public function store(
        StoreAgentRequest $request,
        AgentService $agentService
    ): JsonResponse {
        
        $agent = $agentService->register(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Agent registered successfully.',
            'data' => new AgentResource($agent->load('kyc')),
        ], 201);
    }
}