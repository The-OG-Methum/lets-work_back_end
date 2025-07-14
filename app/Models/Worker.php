<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'nic',
        'name',
        'address',
        'daily_rate',
        'transportaion_fee',
        'zone'

    ];
}
