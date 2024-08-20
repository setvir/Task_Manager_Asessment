<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('task');
});
Route::resource('task',TaskController::class);
Route::resource('project',ProjectController::class);
Route::put('/task/{task}/updatePriority', [TaskController::class, 'updatePriority'])->name('task.updatePriority');