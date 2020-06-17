<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['subscriber_id', 'author_id'];
    
    public function subscriber() {
        return $this->belongsTo(User::class);
    }
    
    public function author() {
        return $this->belongsTo(User::class);
    }
}
