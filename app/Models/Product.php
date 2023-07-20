<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        "provider_id",
        "reference",
        "name",
        "description",
        "stock",
        "price",
        "discount",
        "tax",
        "images",
        "param_size",
        "param_gender",
        "param_subcategory",
        "param_brand",
        "param_color",
        "param_state",
        
    ];
    return $this->belongsToMany(Product::class);
}
