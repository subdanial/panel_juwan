<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = [
        'name','lastname','phone','city','address','balance','user_id'
    ];
    function user(){
        return $this->belongsTo(User::class);
    }

    function orders(){
        return $this->hasMany(Order::class);
    }
}
