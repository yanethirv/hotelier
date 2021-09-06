<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'cost', 'type_id', 'attachment', 'cod_product', 'cod_price'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }

        return $query->where('name', 'like', "%{$val}%")
                    //->orWhere('description', 'like', "%{$val}%")
                    ->orWhere('price', 'like', "%{$val}%")
                    ->orWhere('cost', 'like', "%{$val}%");
                    //->orWhere('type_id', 'like', "%{$val}%");
    }


    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function serviceTransactions(){
        return $this->hasMany(ServicesTransaction::class);
    }
}
