<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    protected $table = 'users_details';
    
    protected $fillable = [
        'user_id',
        'street',
        'house_no',
        'zip',
        'city',
        'marital_status',
        'profession',
        'place_of_birth',
        'country_of_birth',
        'nationality',
        'nationality_2',
        'country_tax_residence',
        'country_us_tax',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
