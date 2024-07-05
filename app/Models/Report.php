<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'year',
        'report',   
        'image',      // Add other fields you may need for your user login history
    ];

    protected $appends = ['report_url', 'image_url'];

    public function getReportUrlAttribute()
    {
        if ($this->report) {
            return url('storage/'.$this->report);
        }

        return null;
    }
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url('storage/'.$this->image);
        }

        return null;
    }
}
