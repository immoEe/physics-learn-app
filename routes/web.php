<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/tasks/first_module/{task}', [CatalogController::class, 'showTask'])
    ->name('tasks.show');

Route::get('/catalog/{section}/{topic}', [CatalogController::class, 'showTopic'])->name('topics.show');


Route::post('/tasks/{task}/check', [TaskController::class, 'check'])
    ->middleware('auth')
    ->name('tasks.check');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'show'])->name('dashboard');
    Route::post('/tasks/{task}/check', [TaskController::class, 'check'])
    ->name('tasks.check');
});




require __DIR__.'/auth.php';
