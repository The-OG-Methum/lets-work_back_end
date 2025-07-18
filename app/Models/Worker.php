<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Worker extends Model
{
    use HasFactory;

    public function attendanceRecords()
    {

        return $this->hasMany(AttendanceRecord::class);
    }

    protected $fillable = [
        'nic',
        'name',
        'address',
        'daily_rate',
        'transportation_fee',
        'status'

    ];


    public function totalAttendance(): Attribute
    {

        return Attribute::get(
            function () {

                return $this->attendanceRecords->flatMap(fn($record) => $record->attendance)
                    ->where('isWorked', true)
                    ->count();
            }

        );
    }


    public function totalSalary(): Attribute

    {

        return Attribute::make(

            get: fn() => collect($this->attendanceRecords)->sum(function ($record) {
                $workedDays = collect($record->attendance)
                    ->where('isWorked', true);

                $daysCount = $workedDays->count();

                $overtime = $workedDays
                    ->where('isOvertime', true)
                    ->sum('overtimeAmount');

                return ($daysCount * $this->daily_rate) + $overtime - $this->transportation_fee;
            })
        );
    }


    protected $appends = ['total_attendance', 'total_salary'];
}
