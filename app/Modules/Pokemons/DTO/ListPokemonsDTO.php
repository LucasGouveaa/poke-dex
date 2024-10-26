<?php

namespace App\Modules\Pokemons\DTO;

use App\Models\Pokemon;

readonly class ListPokemonsDTO
{

    /**
     * @var PokemonDetailDTO[]
     */
    public array $pokemons;

    /**
     * @param Pokemon[] $pokemons
     * @param int $currentPage
     * @param int $lastPage
     * @param int $perPage
     * @param int $total
     */
    public function __construct(
        array      $pokemons,
        public int $currentPage,
        public int $lastPage,
        public int $perPage,
        public int $total,
    )
    {
        $this->pokemons = array_map(fn(Pokemon $pokemon) => PokemonDetailDTO::fromPokemon($pokemon), $pokemons);
    }
}
