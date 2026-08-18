<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentDocument extends Model
{
    protected $fillable = [
        'agent_id',
        'document_type',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'status',
        'verification_remarks',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
