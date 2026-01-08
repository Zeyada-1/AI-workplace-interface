<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AiProjectController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/projects');
});

Route::get('/test', function () {
    return 'Server is working!';
});

// Public routes (anyone can view)
Route::get('/projects', [AiProjectController::class, 'index']);

// Protected routes (require authentication) - MUST come before {id} routes
Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [AiProjectController::class, 'create']);
    Route::post('/projects', [AiProjectController::class, 'store']);
    Route::get('/projects/{id}/edit', [AiProjectController::class, 'edit']);
    Route::patch('/projects', [AiProjectController::class, 'update']);
    Route::delete('/projects', [AiProjectController::class, 'destroy']);
    
    // Admin routes
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.toggle');
});

// Show route comes AFTER specific routes to avoid conflicts
Route::get('/projects/{id}', [AiProjectController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
