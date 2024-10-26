<?php

namespace App\Http\Controllers;

use App\Modules\Pokemons\Services\Actions\ListPokemons;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokedexController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json(ListPokemons::fromRequest($request)->execute());
    }

    public function sync(): JsonResponse
    {
        exec('php D:\ProjetosPhp\ApiPokedexV2\artisan app:pokedex-command > NUL 2>&1 &');

        return response()->json(['message' => 'Sincronização iniciada.']);
    }
}
