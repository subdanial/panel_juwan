<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'user_id',
        'status',
        'type',
        'returned',
        'amount',
        'amount_financial',
        'amount_returned',
        'discount',
        'pos',
        'cheque',
        'cash',
        'description',
        'image',
        'submimt_slug',
        'maali_status',
        'anbaar_status',
        'date_manual'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
