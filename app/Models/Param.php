<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    use HasFactory;

    protected $fillable = [

        "paramtype_id",
        "name",
        "param_foreing",
        "param_state",
        
    ];

    public function param (){
        return $this->belongsToMany(Param::class);
    }
    
}
