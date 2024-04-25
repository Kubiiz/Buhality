<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

Route::get('/', [PageController::class, 'home'])->name('dashboard');

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
        Route::get('{game}/continue', [GameController::class, 'continue'])->name('continue');
        Route::get('{game}/edit', [GameController::class, 'edit'])->name('edit');
        Route::patch('{game}', [GameController::class, 'update'])->name('update');
        Route::delete('{game}', [GameController::class, 'destroy'])->name('destroy');
    });

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group( function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('info', [AdminController::class, 'info'])->name('info');
    Route::get('info/create', [AdminController::class, 'create'])->name('info.create');
    Route::post('info/create', [AdminController::class, 'store'])->name('info.store');
    Route::get('{info}/edit', [AdminController::class, 'edit'])->name('info.edit');
    Route::patch('{info}', [AdminController::class, 'update'])->name('info.update');
    Route::delete('{info}', [AdminController::class, 'destroy'])->name('info.destroy');
});

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'lv'])) {
        session(['language' => $locale]);
    }

    return back();
})->name('language');;


require __DIR__.'/auth.php';
