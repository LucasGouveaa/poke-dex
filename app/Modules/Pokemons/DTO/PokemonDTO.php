<?php

namespace App\Modules\Pokemons\DTO;

use App\Support\StringUtil;
use Illuminate\Support\Arr;

readonly class PokemonDTO
{
    public function __construct(
        public int     $id,
        public string  $name,
        public string  $abilities,
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

    public static function fromArray(array $data): self
    {
        $abilities = collect($data['abilities'])->map(function ($ability) {
            return StringUtil::ucFirstPhrase($ability['ability']['name']);
        })->toArray();

        return new self(
            $data['id'],
            StringUtil::ucFirstPhrase($data['name']),
            json_encode($abilities),
            $data['sprites']['front_default'] ?? null,
            ['sprites']['back_default'] ?? null,
            $data['sprites']['front_female'] ?? null,
            $data['sprites']['back_female'] ?? null,
            $data['sprites']['front_shiny'] ?? null,
            $data['sprites']['back_shiny'] ?? null,
            $data['sprites']['front_shiny_female'] ?? null,
            $data['sprites']['back_shiny_female'] ?? null,
            $data['types'] ?? [],
        );
    }

    public function toArray(): array
    {
        return Arr::except(json_decode(json_encode($this), true), [
            'id',
            'types'
        ]);
    }
}
