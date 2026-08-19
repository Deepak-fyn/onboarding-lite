<?php

use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AgentController as AdminAgentController;
use App\Http\Controllers\AgentDocumentController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/agents/register', [AgentController::class, 'create'])
    ->name('agents.create');

Route::post('/agents/register', [AgentController::class, 'store'])
    ->name('agents.register');

Route::get('/admin/agents', [AdminAgentController::class, 'index'])
    ->name('admin.agents.index');

    Route::post(
    '/admin/agents/{agent}/approve',
    [AdminAgentController::class, 'approve']
)->name('admin.agents.approve');

Route::post(
    '/admin/agents/{agent}/reject',
    [AdminAgentController::class, 'reject']
)->name('admin.agents.reject');

Route::get(
    '/agents/{agent}/documents',
    [AgentDocumentController::class, 'create']
)->name('agents.documents.create');

Route::post(
    '/agents/{agent}/documents',
    [AgentDocumentController::class, 'store']
)->name('agents.documents.store');

Route::get(
    '/admin/agent-documents',
    [AgentDocumentController::class, 'index']
)->name('admin.agent-documents.index');

Route::post(
    '/admin/agent-documents/{document}/update-status',
    [AgentDocumentController::class, 'updateStatus']
)->name('admin.agent-documents.update-status');

Route::patch(
    '/admin/agent-documents/{document}/status',
    [AgentDocumentController::class, 'updateStatus']
)->name('admin.agent-documents.status');

Route::get(
    '/admin/agent-documents/{document}/view',
    [AgentDocumentController::class, 'view']
)->name('admin.agent-documents.view');

Route::post(
    '/agent/login',
    [AgentController::class, 'webLogin']
);