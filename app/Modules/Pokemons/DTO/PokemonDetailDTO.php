<?php

namespace App\Modules\Pokemons\DTO;

use App\Models\Pokemon;
use App\Support\StringUtil;
use Illuminate\Support\Arr;

readonly class PokemonDetailDTO
{
    public function __construct(
        public int     $id,
        public string  $name,
        public ?string $habitat,
        public array   $abilities,
        public ?string $front_default,
        public ?string $back_default,
        public ?string $front_female,
        public ?string $back_female,
        public ?string $front_shiny,
        public ?string $back_shiny,
        public ?string $front_shiny_female,
        public ?string $back_shiny_female,
        public array   $types,
    )
    {
    }

    public static function fromPokemon(Pokemon $pokemon): self
    {
        return new self(
            $pokemon->id,
            $pokemon->name,
            $pokemon->habitat,
            json_decode($pokemon->abilities, true),
            $pokemon->front_default,
            $pokemon->back_default,
            $pokemon->front_female,
            $pokemon->back_female,
            $pokemon->front_shiny,
            $pokemon->back_shiny,
            $pokemon->front_shiny_female,
            $pokemon->back_shiny_female,
            $pokemon->types()->get()->select(['id', 'name', 'img_url'])->toArray()
        );
    }
}
