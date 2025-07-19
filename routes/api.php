<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/workers', [WorkerController::class, 'index']);
    Route::post('/workers', [WorkerController::class, 'store']);

    Route::get('/dashboard/stats', [DashboardController::class, 'index']);

    Route::get('/attendance/{worker_id}', [AttendanceController::class, 'index']);
    Route::get('/attendance/{worker_id}/summary', [AttendanceController::class, 'getAttendanceSummary']);
    Route::post('/attendance/{worker_id}', [AttendanceController::class, 'createAttendance']);

    Route::delete('/workers/{id}',[WorkerController::class,'destroy']);

    Route::put('/workers/{id}',[WorkerController::class,'update']);

    Route::post('/logout',[UserController::class,'logout']);
});

// Public routes
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
