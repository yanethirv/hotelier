<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'suggestion', 'description', 'property_id'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%")
                    ->orWhere('suggestion', 'like', "%{$val}%")
                    ->orWhere('description', 'like', "%{$val}%");
    }

    //Relación uno a muchos inversa
    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
