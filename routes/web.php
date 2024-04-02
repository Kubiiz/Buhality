<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('dashboard');

Route::get('new-game', [PageController::class, 'create'])->middleware('auth');
Route::post('new-game', [PageController::class, 'store'])->middleware('auth');

Route::get('game', [GameController::class, 'index'])->middleware('auth');
Route::get('game/run', [GameController::class, 'game'])->middleware('auth');
Route::get('game/stop', [GameController::class, 'stop'])->middleware('auth');

Route::get('history', [PageController::class, 'history'])->middleware('auth');
Route::get('history/{id}/delete', [PageController::class, 'destroy'])->middleware('auth');

Route::get('/info', [PageController::class, 'info']);
Route::post('/info', [PageController::class, 'contact']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
