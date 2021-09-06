<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'attachment', 'property_id', 
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
}
