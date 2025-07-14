<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id', 'month', 'year', 'attendance'
    ];

    protected $casts = [
        'attendance' => 'array',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}

