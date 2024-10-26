<?php

namespace App\Infra\Pokedex;

use Illuminate\Http\Client\PendingRequest;

readonly class PokedexClient implements Infra\PokedexClientInterface
{

    public function __construct(
        private PendingRequest $client,
    )
    {
    }

    public function createOrUpdatePokemons(): void
    {

    }
}
