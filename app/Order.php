<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=[
        'name',
        'address',
    ];

    public function order_details(){
        return $this->hasMany(Order_Detail::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
