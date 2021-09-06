<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }

        return $query->where('type', 'like', "%{$val}%")
                    ->orWhere('data', 'like', "%{$val}%");
    }

}
