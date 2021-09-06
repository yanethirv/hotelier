<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'description', 'user_id', 'stripe_id', 'customer', 'customer_email', 'hosted_invoice_url',
        'invoice_pdf', 'total', 'status', 'details', 'trans_number', 'trans_date', 'trans_bank', 'note'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('amount', 'like', "%{$val}%")
                    ->orWhere('description', 'like', "%{$val}%");
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
