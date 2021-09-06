<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    public function scopeSearch($query, $val){

        return $query
            ->where('name','like','%'.$val.'%')
            ;
    }

    public function restaurants(){
        return $this->hasMany(Restaurant::class);
    }
}
