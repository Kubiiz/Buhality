<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('dashboard');

Route::get('new-game', 'PageController@create')->middleware('auth');
Route::post('new-game', 'PageController@store')->middleware('auth');

Route::get('game', 'GameController@index')->middleware('auth');
Route::get('game/run', 'GameController@game')->middleware('auth');
Route::get('game/stop', 'GameController@stop')->middleware('auth');

Route::get('history', 'PageController@history')->middleware('auth');
Route::get('history/{id}/delete', 'PageController@destroy')->middleware('auth');

Route::get('/info', [PageController::class, 'info']);
Route::post('/info', [PageController::class, 'contact']);
Route::get('/rules', [PageController::class, 'rules']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
