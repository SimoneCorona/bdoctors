<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Specialty;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'surname', 
        'address',
        'specialties_name', 
        'slug',
        'email', 
        'password',
    ];

    public function specialties() {
        return $this->belongsToMany('App\Specialty');
    }

    public function sponsorship() {
        return $this->belongsToMany('App\Sponsorship');
    }

    public function message() {
        return $this->hasMany('App\Message');
    }

    public function review() {
        return $this->hasMany('App\Reviews');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
