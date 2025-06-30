<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;


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

    // Rotas para Hotels
    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('hotels/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
    Route::get('hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::put('hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
    Route::patch('hotels/{hotel}', [HotelController::class, 'update']);
    Route::delete('hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    // Rotas para Leads
    Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::patch('leads/{lead}', [LeadController::class, 'update']);
    Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');
    
    Route::get('/leads-export-csv', [LeadController::class, 'exportCsv'])->name('leads.export.csv');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Rotas para Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

