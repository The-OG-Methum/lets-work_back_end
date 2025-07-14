<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/workers', [WorkerController::class, 'index']);

Route::get('/dashboard/stats',[DashboardController::class,'index']);

Route::get('/attendance/{worker_id}',[AttendanceController::class,'index']);

Route::get('/attendance/{worker_id}/summary',[AttendanceController::class,'getAttendanceSummary']);

// GET /api/attendance/{workerId}/summary?month={month}&year={year}