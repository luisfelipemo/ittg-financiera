<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id', 'loan_id', 'payment_number', 'amount', 'date_payment', 'received_amount',
    ];

    public function client()
    {
        return $this->belongsTo('App\Payment');
    }
}
