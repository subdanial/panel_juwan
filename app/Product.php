<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','code','code_system','name','image','sizes','price','price_financial'];
    
    function category(){
        return $this->belongsTo(Category::class);
    }

    function colors(){
        return $this->hasMany(Color::class,'product_id','id');
    }

    function boxes(){
        return $this->hasManyThrough(
            //hasmany box dare az tarighe color
            Box::class,
            Color::class,
            'product_id',
            'color_id');
    }
}
