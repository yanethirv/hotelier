<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'services_transaction_id', 'comment', 'request_status_id', 
    ];

    public function servicesTransaction(){
        return $this->belongsTo(ServicesTransaction::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }
}
