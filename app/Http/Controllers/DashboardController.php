<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use App\Models\Worker;
use Illuminate\Http\Request;

class DashboardController extends UserController
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $allWorkers = Worker::where('status','working')->count();
    $allWorkersDailyRates = Worker::sum('daily_rate');
    $avgDailyRate = $allWorkers > 0 ? $allWorkersDailyRates / $allWorkers : 0;

    // Total attendance: sum of all worked days across all records
    $totalAttendance = AttendanceRecord::all()->
    where('status','working')
    ->sum(function($record) {
        return collect($record->attendance)
            ->where('isWorked', true)
            ->count();
    });

    // Total salaries: sum of all workers' total_salary
    $totalSalaries = Worker::all()->where('status','working')->sum(function($worker) {
        return $worker->total_salary; // uses your accessor
    });

    return response()->json([
        'totalWorkers' => $allWorkers,
        'totalSalaries' => $totalSalaries,
        'totalAttendance' => $totalAttendance,
        'avgDailyRate' => $avgDailyRate
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
