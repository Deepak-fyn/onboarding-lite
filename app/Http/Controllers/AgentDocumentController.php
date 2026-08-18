<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\AgentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentDocumentController extends Controller
{
    public function create(Agent $agent)
    {
        return view(
            'agents.documents.create',
            compact('agent')
        );
    }

    public function store(Request $request, Agent $agent)
    {
        $request->validate([
            'pan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'license' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $documents = [
            'pan',
            'aadhar',
            'certificate',
            'license',
        ];

        foreach ($documents as $documentType) {

            if (!$request->hasFile($documentType)) {
                continue;
            }

            $file = $request->file($documentType);

            $filePath = $file->store(
                "agents/{$agent->id}/{$documentType}"
            );

            AgentDocument::create([
                'agent_id' => $agent->id,
                'document_type' => $documentType,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'status' => 'pending',
            ]);
        }

        return redirect()
            ->route('agents.documents.create', $agent)
            ->with('success', 'Documents uploaded successfully.');
    }

    public function index()
    {
        $documents = AgentDocument::with('agent')
            ->latest()
            ->get();

        return view(
            'admin.agent-documents.index',
            compact('documents')
        );
    }

    public function view(AgentDocument $document)
    {
        if (!Storage::disk('local')->exists($document->file_path)) {
            abort(404);
        }

        return Storage::disk('local')->response(
            $document->file_path
        );
    }

    public function updateStatus(
        Request $request,
        AgentDocument $document
    ) {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'verification_remarks' => 'nullable|string|max:1000',
        ]);

        $document->update([
            'status' => $request->status,
            'verification_remarks' => $request->verification_remarks,
        ]);

        return back()->with(
            'success',
            'Document status updated successfully.'
        );
    }
}