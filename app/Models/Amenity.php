<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'icon'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%");
    }

    //Relación uno a muchos inversa
    public function properties(){
        return $this->belongsToMany(Property::class);
    }
}
