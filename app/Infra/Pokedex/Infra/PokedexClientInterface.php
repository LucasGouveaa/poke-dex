<?php

namespace App\Infra\Pokedex\Infra;

interface PokedexClientInterface
{
    public function createOrUpdatePokemons(): void;
}
