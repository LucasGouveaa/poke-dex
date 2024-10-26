<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->group(function () {
    Route::prefix('pokemons')->group(function () {
        Route::get('/', 'PokemonController@index');
    });
});
