<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeSearch($query, $val){

        return $query
            ->where('name','like','%'.$val.'%')
            ;
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function activationServices(){
        return $this->hasMany(ActivationService::class);
    }
}
