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
        'cv',
        'photo'
    ];

    public function specialties() {
        return $this->belongsToMany('App\Specialty');
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function getAvgRatingAttribute() {
        return floatval($this->reviews()->avg('rating'));
    }
     
    public function getReviewCountAttribute() {
        return $this->reviews()->count();
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
        'phone_number' => 'integer'
    ];
    
    /**
     *
     * The accessors to append to the model's array form.
          * @var array
     */
    protected $appends = ['avg_rating','review_count'];
}
