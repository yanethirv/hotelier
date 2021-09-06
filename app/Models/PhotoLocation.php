<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%");
                    
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }
}
