<?php

use App\Http\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['status' => 'ok']);
});

Route::prefix('v1')->group(function () {
    Route::prefix('pokemons')->group(function () {
        Route::get('/', [PokedexController::class, 'index']);
        Route::get('sync', [PokedexController::class, 'sync']);
    });
});
