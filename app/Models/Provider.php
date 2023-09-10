<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [

        "legal_name",
        "commercial_name",
        "email",
        "phone",
        "address",
        "param_city",
        "name_contact",
        "param_bank",
        "param_account",
        "account",
        "param_state",
        
    ];

    public function provider (){
        return $this->belongsToMany(Provider::class);
    }
    
}
