<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokedexController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([]);
    }
}
