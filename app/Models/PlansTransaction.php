<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlansTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'plan_id', 'stripe_id', 'request_status_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }

    public function planStatuses(){
        return $this->hasMany(PlanStatus::class);
    }
}
