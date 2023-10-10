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
        'videos'
    ];


    protected $casts = [
        'images' => 'array',
        'videos' => 'array'
    ];

    protected $appends = ['owner'];


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
    
        public function likes()
    {
        return $this->hasMany(Like::class);
    }

        public function isLikedByLoggedInUser()
    {
        return $this->likes->contains('user_id', auth()->user()->id);
    }
}
    