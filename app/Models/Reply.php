<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $appends = ['owner'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerAttribute(){
        if(auth()->check()){
            return $this->user->id == auth()->id();
        }

        return false;
    }
}
