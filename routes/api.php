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
    
    // Rotas explícitas para hotels
    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.api.index');
    Route::post('hotels', [HotelController::class, 'store'])->name('hotels.api.store');
    Route::get('hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.api.show');
    Route::put('hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.api.update');
    Route::patch('hotels/{hotel}', [HotelController::class, 'update']);
    Route::delete('hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.api.destroy');

    Route::post('/leads/harmonika', [LeadController::class, 'createLeadFromHarmonika']);

    // Rotas explícitas para leads
    Route::get('leads', [LeadController::class, 'index'])->name('leads.api.index');
    Route::post('leads', [LeadController::class, 'store'])->name('leads.api.store');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.api.show');
    Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.api.update');
    Route::patch('leads/{lead}', [LeadController::class, 'update']);
    Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.api.destroy');
    Route::get('/leads-export', [LeadController::class, 'export']);
    
    Route::get('/reports/summary', [LeadController::class, 'summary']);
    Route::get('/reports/by-hotel', [LeadController::class, 'reportByHotel']);
}); 