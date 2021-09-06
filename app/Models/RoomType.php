<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
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

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
