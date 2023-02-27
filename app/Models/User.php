<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
     use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'category_id',
        'user_id',
        'image',
        'category_name',
        'name',
        'first_name',
        'last_name',
        'phone',
        'password',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token'
    ];

    protected $appends = ['name'];

    public function posts() {
  
        return $this->hasMany(Post::class);
    }

    public function getNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }
}
