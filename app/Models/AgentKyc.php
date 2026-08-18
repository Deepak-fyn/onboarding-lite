<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentKyc extends Model
{
    protected $fillable = [
        'agent_id',
        'pan_number',
        'aadhar_number',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}