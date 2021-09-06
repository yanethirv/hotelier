<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'property_id', 'policy_type_id',
    ];

    public function scopeSearch($query, $val){
        return $query
            ->where('name','like','%'.$val.'%')
            ;
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }
    
    public function policyType(){
        return $this->belongsTo(PolicyType::class);
    }
}
