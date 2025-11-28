<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/refresh-captcha', function () {
    return response()->json(['captcha'=> captcha_src()]);
});


Route::get('/unlink-storage', function () {
    try {
        // Unlink (Delete) storage link
        if (file_exists(public_path('storage'))) {
            unlink(public_path('storage'));
        }
        return "Storage link removed successfully!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/link-storage', function () {
    try {
        // Create a new storage link
        Artisan::call('storage:link');
        return "Storage link created successfully!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

 Route::get('clear-cache', function(){
        Artisan::call('optimize');
        echo 'success';
    });

require __DIR__.'/auth.php';
require __DIR__.'/frontend.php';
require __DIR__.'/backend.php';




