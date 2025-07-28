<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SmsMessages extends Model
{
    protected $fillable = [
        'smsable_id',
        'smsable_type',
        'phone_number',
        'message',
        'verify_code',
        'status',
        'type',
        'provider',
        'provider_message_id',
        'sent_at',
        'delivered_at',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    
    /**
     * Scope a query to only include records of a given verification code.
     */
    public function scopeVerifyCode($query, string $code)
    {
        return $query->where('verify_code', $code);
    }
    /**
     * Scope a query to only include records of a given status.
     */
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include records of a given phone number.
     */
    public function scopePhoneNumber($query, string $number)
    {
        return $query->where('phone_number', $number);
    }

    /**
     * Scope a query to only include records of a given type.
     */
    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }
    /**
     * Get the parent smsable model (e.g., User).
     */
    public function smsable(): MorphTo
    {
        return $this->morphTo();
    }
}
