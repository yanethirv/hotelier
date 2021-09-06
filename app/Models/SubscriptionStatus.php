<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriptions_transaction_id', 'comment', 'request_status_id', 
    ];

    public function subscriptionsTransaction(){
        return $this->belongsTo(SubscriptionsTransaction::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }
}
