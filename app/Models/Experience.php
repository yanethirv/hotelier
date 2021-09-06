<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    public function scopeSearch($query, $val){

        return $query
            ->where('name','like','%'.$val.'%')
            //->Orwhere('name','like','%'.$val.'%)
            ;
    }

    //Relación uno a muchos inversa
    public function properties(){
        return $this->belongsToMany(Property::class);
    }
}
