<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'venue',
        'twitter_link',
        'social_media_links',
        'main_image',
        'date'

    ];


    protected $casts = [
        'other_images' => 'array',
        
    ];

    protected $appends = ["other_images_url", "main_image_url",];


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

    
        public function likes()
    {
        return $this->hasMany(Like::class);
    }

        public function isLikedByLoggedInUser()
    {
        return $this->likes->contains('user_id', auth()->user()->id);
    }

    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return url('storage/' . $this->main_image);
        }
        return null;
    }

     public function getOtherImagesUrlAttribute()
    {
        if ($this->other_images) {
            $imagesUrl = [];
            foreach($this->other_images as $image){
                $imageUrl = url('storage/' . $image);
                array_push($imagesUrl, $imageUrl);
            }
            return $imagesUrl;
        }
        return null;
    }
}
    