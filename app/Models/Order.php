<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nama',
        'no_meja',
        'payment_method',
        'status',
        'items',
    ];
}
