<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        
        "user_id",
        "code",
        "date",
        "total",
        "param_paymethod",
        "param_status",
        "param_state",
        
    ];
    return $this->belongsToMany(Order::class);
}
