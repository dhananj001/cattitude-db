<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\StaffController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('records', RecordController::class);
    Route::resource('staff', StaffController::class);

    // Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');

    // Route::put('/staff/{user}/update-role', [StaffController::class, 'updateRole'])->name('staff.updateRole');

    Route::post('/users/{id}/assign-role', [StaffController::class, 'assignRole'])->name('users.assignRole');
    Route::post('/users/{id}/remove-role', [StaffController::class, 'removeRole'])->name('users.removeRole');
});

require __DIR__ . '/auth.php';
