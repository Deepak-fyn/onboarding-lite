<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'status',
    ];

    public function kyc()
    {
        return $this->hasOne(AgentKyc::class);
    }

    public function documents()
    {
        return $this->hasMany(AgentDocument::class);
    }
}
