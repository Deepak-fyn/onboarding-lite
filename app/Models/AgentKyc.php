<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class AgentKyc extends Model
{
    protected $fillable = [
        'agent_id',
        'pan_number',
        'aadhar_number',
    ];

    protected function panNumber():Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::decryptString($value),
            set: fn ($value) => Crypt::encryptString($value),
        );
    }

    protected function aadharNumber():Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::decryptString($value),
            set: fn ($value) => Crypt::encryptString($value),
        );
    }



    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}