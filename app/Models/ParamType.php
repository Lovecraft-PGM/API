<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamType extends Model
{
    use HasFactory;

    protected $fillable = [
        
        "name",
        "range_min",
        "range_max",
        
    ];

    public function paramType (){
        return $this->belongsToMany(ParamType::class);
    }
    
}
