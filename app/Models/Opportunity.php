<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'date',
        'cover_pic',

        // Add other fields you may need for your user login history
    ];

    protected $casts = [
        'documents' => 'array',

    ];

    protected $appends = ['cover_pic_url', 'documents_url'];

    public function getDocumentsUrlAttribute()
    {
        if ($this->documents) {
            if (is_array($this->documents)) {
                // If documents is an array, map each document to its URL
                return array_map(function ($document) {
                    return url('storage/'.$document);
                }, $this->documents);
            } else {
                // If documents is a string, return its URL
                return url('storage/'.$this->documents);
            }
        }

        return null;
    }

    public function getCoverPicUrlAttribute()
    {
        if ($this->cover_pic) {
            return url('storage/'.$this->cover_pic);
        }

        return null;
    }
}
