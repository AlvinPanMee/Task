<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/tasks', [TaskController::class, 'create']);
Route::get('/tasks', [TaskController::class, 'view']); 
Route::get('/tasks/{id}', [TaskController::class, 'view']); 
Route::put('/tasks/{id}', [TaskController::class, 'update']); 
Route::delete('/tasks/{id}', [TaskController::class, 'delete']); 
Route::put('/tasks/{id}/complete', [TaskController::class, 'complete']); 






