<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokedexController;
use App\Http\Middleware\Jwt;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['status' => 'ok']);
});

Route::prefix('v1')->group(function () {
    Route::prefix('pokemons')->middleware('auth:api')->group(function () {
        Route::get('/', [PokedexController::class, 'index']);
    });

    Route::prefix('habitats')->middleware('auth:api')->group(function () {
        Route::get('/', [PokedexController::class, 'getHabitats']);
    });

    Route::prefix('types')->middleware('auth:api')->group(function () {
        Route::get('/', [PokedexController::class, 'getTypes']);
    });

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware(Jwt::class);
        Route::get('change-password', [AuthController::class, 'changePassword'])->middleware(Jwt::class);
        Route::get('me', [AuthController::class, 'me']);
    });
});
