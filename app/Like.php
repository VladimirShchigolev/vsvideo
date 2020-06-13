<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['owner', 'video'];
    
    public function owner() {
        return $this->belongsTo(User::class);
    }
    
    public function video() {
        return $this->belongsTo(Video::class);
    }
}

