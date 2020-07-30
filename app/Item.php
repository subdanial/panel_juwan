<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'order_id','box_id','count','count_total','box_name','box_color','product_color','product_image','product_id','product_code','product_name','product_category','product_price','product_price_total','product_price_financial','product_price_total_financial'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function boxe()
    {
        return $this->belongsTo(Box::class);
    }

}
