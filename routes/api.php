<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\LeadController;

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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::apiResource('hotels', HotelController::class);
    
    Route::apiResource('leads', LeadController::class);
    Route::get('/leads-export', [LeadController::class, 'export']);
    
    Route::get('/reports/summary', [LeadController::class, 'summary']);
    Route::get('/reports/by-hotel', [LeadController::class, 'reportByHotel']);
}); 