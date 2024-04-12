<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

Route::get('/', [PageController::class, 'home'])->name('dashboard');
Route::get('test', [PageController::class, 'test'])->name('test');

Route::get('info', [PageController::class, 'info'])->name('info');
Route::post('info', [PageController::class, 'contact'])->name('info.contact');

Route::middleware('auth')->group(function () {
    Route::get('games', [GameController::class, 'games'])->name('games');
    
    Route::get('new-game', [GameController::class, 'create'])->name('newgame');
    Route::post('new-game', [GameController::class, 'store'])->name('newgame.store');

    Route::prefix('game')->name('game.')->group(function () {
        Route::get('/', [GameController::class, 'index'])->name('index');
        Route::get('action', [GameController::class, 'action'])->name('action');
        Route::get('stats', [GameController::class, 'stats'])->name('stats');
        Route::get('reset', [GameController::class, 'reset'])->name('reset');
        Route::get('stop', [GameController::class, 'stop'])->name('stop');
        Route::get('{id}/continue', [GameController::class, 'continue'])->name('continue');
        Route::get('{id}/edit', [GameController::class, 'edit'])->name('edit');
        Route::post('{id}/edit', [GameController::class, 'update'])->name('update');
        Route::get('{id}/delete', [GameController::class, 'destroy'])->name('destroy');
    });

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group( function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('info', [AdminController::class, 'info'])->name('info');
});


require __DIR__.'/auth.php';
