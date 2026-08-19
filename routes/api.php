<?php

use App\Http\Controllers\AgentDocumentController;
use App\Http\Controllers\Api\AgentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentAuthController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\MenuController;



Route::middleware('auth:sanctum')->get(
    '/menu',
    [MenuController::class, 'index']
);

Route::middleware([
    'auth:sanctum',
    'role:SuperAdmin',
    ])->group(function () {

    Route::patch(
        '/admin/agents/{agent}/role',
        [RoleManagementController::class, 'updateAgentRole']
    );

});


Route::middleware('auth:sanctum')->group(function () {

    Route::get(
        '/agent-documents',
        [AgentDocumentController::class, 'index']
    )->middleware('permission:view documents');

    Route::get(
        '/agent-documents/{document}/view',
        [AgentDocumentController::class, 'view']
    )->middleware('permission:view documents');
    
    Route::post(
        '/agents/{agent}/documents',
        [AgentDocumentController::class, 'store']
        )->middleware('permission:upload documents');
        
        Route::patch(
            '/agent-documents/{document}/status',
            [AgentDocumentController::class, 'updateStatus']
    )->middleware('permission:verify documents');

    
    
    });
    Route::post('/agent/login', [AgentAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {

    Route::post(
        '/agent/logout',
        [AgentAuthController::class, 'logout']
    );

});