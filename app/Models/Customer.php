<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'number',
        'address'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
