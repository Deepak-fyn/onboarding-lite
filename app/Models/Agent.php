<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Agent extends Authenticatable
{
    use HasApiTokens,HasRoles;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'status',
        'password'
    ];

    protected $hidden = [
        'password',
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
