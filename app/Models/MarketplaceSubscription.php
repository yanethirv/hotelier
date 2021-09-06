<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'subscription_name', 'description', 'amount', 'price', 'room_range_id', 'active',
    ];

    public function roomRange(){
        return $this->belongsTo(RoomRange::class);
    }

    public function subscriptionTransactions(){
        return $this->hasMany(SubscriptionsTransaction::class);
    }
}
