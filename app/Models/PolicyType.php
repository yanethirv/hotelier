<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyType extends Model
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

    public function policies(){
        return $this->hasMany(Policy::class);
    }
}
