<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionsTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'marketplace_subscription_id', 'stripe_id', 'subscription_status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function marketplaceSubscription() {
        return $this->belongsTo(MarketplaceSubscription::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }

    public function subscriptionStatuses(){
        return $this->hasMany(SubscriptionStatus::class);
    }

}
