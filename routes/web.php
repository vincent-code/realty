<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComplexController;
use App\Http\Controllers\ComplexDetailController;
use App\Http\Controllers\ComplexCountController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FavoriteManagerController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('complexes')->group(function () {
    Route::match(['get', 'post'], '/', ComplexController::class)
        ->name('complexes');

    Route::get('/{id}', [ComplexDetailController::class, 'description'])
        ->name('complex_detail.description')
        ->where('id', '[a-z0-9]{24}');

    Route::get('/{id}/apartments', [ComplexDetailController::class, 'apartments'])
        ->name('complex_detail.apartments')
        ->where('id', '[a-z0-9]{24}');
});

Route::post('/complexes/count', ComplexCountController::class);

Route::get('/favorite', FavoriteController::class)
    ->name('favorite');

Route::post('/favorite/add', [FavoriteManagerController::class, 'add']);

Route::post('/favorite/remove', [FavoriteManagerController::class, 'remove']);
