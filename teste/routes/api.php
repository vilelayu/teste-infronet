<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::post('/tasks', [TasksController::class, 'store']);
Route::match(['put', 'patch'], 'tasks/{id}', [TasksController::class, 'update']);
Route::get('/tasks', [TasksController::class, 'index']);
