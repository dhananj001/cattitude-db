<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\AdminMiddleware;



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

    Route::post('/users/{user}/assignRole', [StaffController::class, 'assignRole']);
    Route::post('/users/{user}/removeRole', [StaffController::class, 'removeRole']);

    Route::get('/users/{user}/getRoles', [StaffController::class, 'getRoles']);

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    });

});

require __DIR__ . '/auth.php';
