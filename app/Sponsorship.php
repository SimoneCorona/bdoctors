<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public function sponsorship() {
        return $this->belongsToMany('App\User');
    }
}
