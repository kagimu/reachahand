<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id', 
        'category_id',
        'desc',
        'price',
        'location',
        'status',
        'size',
        'type',
        'quick_true',
        'saved',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    protected $appends = ['owner'];


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getOwnerAttribute(){
        if(auth()->check()){
            return $this->user->id == auth()->id();
        }

        return false;
    }
}
