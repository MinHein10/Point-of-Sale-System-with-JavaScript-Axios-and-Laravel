<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unitprice',
        'amount',
        'discount',
    ];

    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }


}
