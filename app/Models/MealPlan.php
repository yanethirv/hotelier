<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'rate', 'property_id'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%")
                    ->orWhere('rate', 'like', "%{$val}%");
                    
    }

    //Relación uno a muchos inversa
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
