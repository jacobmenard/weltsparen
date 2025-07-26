<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    /**
     * Get all SMS messages for the user.
     */
    public function smsMessages(): MorphMany
    {
        return $this->morphMany(SmsMessages::class, 'smsable');
    }
}
