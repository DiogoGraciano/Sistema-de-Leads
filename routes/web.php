<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ReportController;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::resource('hotels', HotelController::class);
    Route::resource('leads', LeadController::class);
    Route::get('/leads-export-csv', [LeadController::class, 'exportCsv'])->name('leads.export.csv');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

