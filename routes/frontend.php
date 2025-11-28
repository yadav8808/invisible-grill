<?php

use App\Http\Controllers\frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/frontend', function () {
        return view('frontend.index');
    });
});
