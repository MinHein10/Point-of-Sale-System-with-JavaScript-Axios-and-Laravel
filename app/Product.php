<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'description',
        'brand',
        'price',
        'quantity',
        'alert_stock',
    ];

    public function order_details(){
        return $this->hasMany(Order_Detail::class);
    }
}
