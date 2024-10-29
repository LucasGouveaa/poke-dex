<?php

namespace App\Http\Controllers;

use App\Modules\Pokemons\Services\Actions\GetHabitats;
use App\Modules\Pokemons\Services\Actions\ListPokemons;
use App\Modules\Types\Services\Actions\GetTypes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
