<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'lastname', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'birthday'
    ];

    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function getBirthdayFormattedAttribute()
    {
        return $this->birthday->format('d/m/Y');
    }

    public function scopeSeek($query)
    {
        return $query->where('username', request('username'))
        ->orWhere('email', request('email'));
    }
}
