<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'service_id', 'service_amount',
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%");
                    
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }

    public function serviceStatuses(){
        return $this->hasMany(ServiceStatus::class);
    }
}
