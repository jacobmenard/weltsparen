<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersRegistrations extends Model
{
    protected $table = 'users_registrations';
    
    protected $fillable = [
        'token',
        'data',
        'step',
        'expires_at',
    ];

    protected $casts = [
        'data' => 'array',
        'step' => 'integer',
        'expires_at' => 'datetime',
    ];

    public function scopeRegToken($query, $token)
    {
        return $query->where('token', $token);
    }
}
