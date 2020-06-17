<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['owner_id', 'video_id', 'text', 'edited', 'creationDate'];
    
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    public function video() {
        return $this->belongsTo(Video::class);
    }
}
