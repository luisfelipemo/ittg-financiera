<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'phone', 'address',
    ];
    //inserción de prestamos
    public function loans()
    {
        return $this->hasMany('App\Loan');
    }
}
