<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'plans_transaction_id', 'comment', 'request_status_id', 
    ];

    public function plansTransaction(){
        return $this->belongsTo(PlansTransaction::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }
}
