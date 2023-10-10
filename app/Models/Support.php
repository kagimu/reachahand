<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'last_name',
        'first_name',
        'password',
        'email',
        'phone',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token'
    ];
}
