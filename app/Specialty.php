<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Specialty extends Model
{
    protected $fillable = [
        'specialty_name'
    ];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public static function specialties()
    {
        return self::all();
    }
}
