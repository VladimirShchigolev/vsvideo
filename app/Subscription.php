<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['subscriber', 'author'];
    
    public function subscriber() {
        return $this->belongsTo(User::class, 'subscriber');
    }
    
    public function author() {
        return $this->belongsTo(User::class, 'author');
    }
}
