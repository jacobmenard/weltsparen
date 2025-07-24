<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'firtstname',
        'lastname',
        'mobile',
        'salutation',
        'title',
        'birthday',
        'password',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    /**
     * Get the user's details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<UserDetails>
     */
    public function details()
    {
        return $this->hasOne(UserDetails::class);
    }

    
    /**
     * Scope a query to only include users of a given email.
     *
     * @param  string  $email
     */
    public function scopeEmail($query, string $email)
    {
        return $query->where('email', $email);
    }
}
