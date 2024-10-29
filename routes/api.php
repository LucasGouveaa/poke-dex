<?php

use App\Http\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['status' => 'ok']);
});

Route::prefix('v1')->group(function () {
    Route::prefix('pokemons')->group(function () {
        Route::get('/', [PokedexController::class, 'index']);
    });

    Route::prefix('habitats')->group(function () {
        Route::get('/', [PokedexController::class, 'getHabitats']);
    });

    Route::prefix('types')->group(function () {
        Route::get('/', [PokedexController::class, 'getTypes']);
    });
});
