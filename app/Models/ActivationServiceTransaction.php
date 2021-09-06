<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationServiceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'activation_service_id', 'request_status_id',
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

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }

    public function activationService() {
        return $this->belongsTo(ActivationService::class);
    }

    public function activationStatuses(){
        return $this->hasMany(ActivationStatuses::class);
    }
}
