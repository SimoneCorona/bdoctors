<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'author',
        'text_review',
        'rating',
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
}
