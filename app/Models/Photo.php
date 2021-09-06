<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'property_id', 'photo_location_id', 'photo_path'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('title', 'like', "%{$val}%");
                    
    }

    //Relación uno a muchos inversa
    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function photoLocation(){
        return $this->belongsTo(PhotoLocation::class);
    }
}
