<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    
    public function activationServiceTransactions(){
        return $this->hasMany(ActivationServiceTransaction::class);
    }

    public function activationStatuses(){
        return $this->hasMany(ActivationStatus::class);
    }

    public function plansTransactions(){
        return $this->hasMany(PlansTransaction::class);
    }

    public function planStatuses(){
        return $this->hasMany(PlanStatus::class);
    }

    public function servicesTransactions(){
        return $this->hasMany(ServicesTransaction::class);
    }

    public function serviceStatuses(){
        return $this->hasMany(ServiceStatus::class);
    }

    public function subscriptionsTransactions(){
        return $this->hasMany(SubscriptionsTransaction::class);
    }

    public function subscriptionStatuses(){
        return $this->hasMany(subscriptionStatuses::class);
    }

}
