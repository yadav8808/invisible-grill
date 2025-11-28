<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\backend\HomeController; // make sure this namespace is correct


Route::prefix('admin')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('auth.login');


        Route::middleware('auth')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
  
    });

});



?>
