<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{


    function orders(){
        return $this->hasMany(Order::class);
    }


    function clients(){
        return $this->hasMany(Client::class);
    }

    protected $fillable = [
        'username','name','lastname','phone','role','password','no_access'
    ];

    use Notifiable;

  
  
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
