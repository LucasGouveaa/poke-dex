<?php

namespace App\Http\Controllers;

use App\Modules\Pokemons\Services\Actions\CapturePokemon;
use App\Modules\Pokemons\Services\Actions\GetHabitats;
use App\Modules\Pokemons\Services\Actions\ListPokemons;
use App\Modules\Pokemons\Services\Actions\ReleasePokemon;
use App\Modules\Types\Services\Actions\GetTypes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class PokedexController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(ListPokemons::fromRequest($request)->execute());
    }

    public function getHabitats(): JsonResponse
    {
        return response()->json((new GetHabitats())->execute());
    }

    public function getTypes(): JsonResponse
    {
        return response()->json((new GetTypes())->execute());
    }

    public function capture(Request $request): JsonResponse
    {
        return response()->json((new CapturePokemon($request->get('pokemonId'), JWTAuth::parseToken()->authenticate()))->execute());
    }

    public function release(Request $request): JsonResponse
    {
        return response()->json((new ReleasePokemon($request->get('pokemonId'), JWTAuth::parseToken()->authenticate()))->execute());
    }
}
