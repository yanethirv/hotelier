<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'activation_service_transaction_id', 'comment', 'request_status_id', 
    ];

    public function activationServiceTransaction(){
        return $this->belongsTo(ActivationServiceTransaction::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }
}
