<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiProjectController;

Route::get('/', function () {
    return redirect('/projects');
});

Route::get('/test', function () {
    return 'Server is working!';
});

Route::get('/projects', [AiProjectController::class, 'index']);
Route::get('/projects/create', [AiProjectController::class, 'create']);
Route::post('/projects', [AiProjectController::class, 'store']);
Route::get('/projects/{id}/edit', [AiProjectController::class, 'edit']);
Route::patch('/projects', [AiProjectController::class, 'update']);
Route::delete('/projects', [AiProjectController::class, 'destroy']);
Route::get('/projects/{id}', [AiProjectController::class, 'show']);
