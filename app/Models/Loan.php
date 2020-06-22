<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'id', 'client_id', 'amount', 'payments_n', 'quota', 'total', 'ministering_date', 'due_date', 'finished'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
