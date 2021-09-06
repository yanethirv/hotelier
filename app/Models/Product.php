<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'stripe_id', 'active'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%")
                    ->orWhere('description', 'like', "%{$val}%");
    }

    public function plans(){
        return $this->hasMany(Plan::class);
    }
}
