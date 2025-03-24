<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/topics/{topic}/tasks', [TaskController::class, 'index'])
    ->name('tasks-list.tasks-1_1');

    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{task}/check', [TaskController::class, 'check'])
    ->middleware('auth')
    ->name('tasks.check');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'show'])->name('dashboard');
    Route::post('/tasks/{task}/check', [TaskController::class, 'check'])
    ->name('tasks.check');
});


require __DIR__.'/auth.php';
