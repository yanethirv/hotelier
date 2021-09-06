<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nickname', 'amount', 'description', 'product_id', 'product', 'product_name', 'stripe_id',
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('nickname', 'like', "%{$val}%")
                    ->orWhere('amount', 'like', "%{$val}%")
                    ->orWhere('product_name', 'like', "%{$val}%");
    }

    //Relación uno a muchos inversa
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function planTransactions(){
        return $this->hasMany(PlansTransaction::class);
    }

}
