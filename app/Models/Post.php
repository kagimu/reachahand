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
        'owner',
        'title',
        'cover_pic',
        'desc',
        'date',
        'tag',
    ];


    protected $appends = ['cover_pic_url'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByLoggedInUser()
    {
        return $this->likes->contains('user_id', auth()->user()->id);
    }

    public function getCoverPicUrlAttribute()
    {
        if ($this->cover_pic) {
            return url('storage/'.$this->cover_pic);
        }

        return null;
    }
}
