<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [

        "o_id",
        "product_id",
        "qty",
        "subtotal",
        "param_state",
        
    ];

    public function orderdetail (){
        return $this->belongsToMany(OrderDetail::class);
    }


    
}
