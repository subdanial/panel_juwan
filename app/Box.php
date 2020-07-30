<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['name','color_id','value'];

    function color(){
        return $this->belongsTo(Color::class);
    }
    
    function items(){
        return $this->hasMany(Item::class);
    }
    
}
