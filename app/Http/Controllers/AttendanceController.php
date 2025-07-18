<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use App\Models\Worker;
use Illuminate\Http\Request;

class AttendanceController extends UserController
{
    public function index($worker_id,Request $request){

        $month = $request->query('month');
        $year = $request->query('year');

        $record = AttendanceRecord::where('worker_id',$worker_id)
        ->where('month', $month)
        ->where('year', $year)
        ->first();

        return response()->json($record ?  $record->attendance : []);

    }


    public function getAttendanceSummary($worker_id, Request $request){

        // {
 // "totalDays": 20,
 // "totalOvertime": 1500,
 // "totalSalary": 51100
//

        $month = $request->query('month');
        $year = $request->query('year');

        $record = AttendanceRecord::where('worker_id',$worker_id)
        ->where('month', $month)
        ->where('year', $year)
        ->first();

         if (!$record) {
        return response()->json([
            'totalDays' => 0,
            'totalOvertime' => 0,
            'totalSalary' => 0
        ]);
         }

        $attendance = collect($record->attendance);
        $totalDays = $attendance->where('isWorked',true)->count();

        $totalOvertime = $attendance->where('isWorked',true)
        ->where('isOvertime',true)->sum('overtimeAmount');

        $worker = Worker::findOrFail($worker_id);

        $totalSalary = ($totalDays * $worker->daily_rate) + $totalOvertime - $worker->transportation_fee;

        return response()->json([
            'totalDays'=>$totalDays,
            'totalOvertime'=>$totalOvertime,
            'totalSalary'=>$totalSalary
        ]);



    

}


    public function createAttendance($worker_id,Request $request){

         $request->validate([
            'month'=>'required|integer|min:1|max:12',
            'year'=>'required|integer',
            'attendance'=>'required|array'
        ]);
        
        $month = $request['month'];
        $year  = $request['year'];
        $attendance = $request['attendance'];

       $record = AttendanceRecord::updateOrCreate([
        
        'worker_id'=>$worker_id,
        'month'=>$month,
        'year'=>$year,
        
       ],
       
       [
        'attendance'=>$attendance
       ]);


       return response()->json([
        'success'=>'true',
        'message'=>'Attendance Saved Successfully',
        'attendance'=>$record->attendance
       ]);



    }











}