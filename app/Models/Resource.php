<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'attachment',
    ];

    public function scopeSearch($query, $val){

        return $query
            ->where('title','like','%'.$val.'%')
            //->Orwhere('name','like','%'.$val.'%)
            ;
    }
}
