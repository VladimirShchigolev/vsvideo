<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['owner', 'path', 'title', 'description', 'blocked', 'public', 'uploadDate'];
    
    public function owner() {
        return $this->belongsTo(User::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function likes() {
        return $this->hasMany(Like::class);
    }
}
