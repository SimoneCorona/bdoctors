<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Specialty extends Model
{
    protected $fillable = [
        'specialty_name',
        'specialty_slug'
    ];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public static function specialties()
    {
        return self::all();
    }
}
