<?php

namespace App\Modules\Pokemons\Services\Actions;

use App\Models\Pokemon;
use App\Modules\Types\DTO\FilterDTO;

readonly class GetHabitats
{
    /**
     * @return FilterDTO[]
     */
    public function execute(): array
    {
        return Pokemon::query()
            ->whereNotNull('habitat')
            ->select('habitat')
            ->orderBy('habitat')
            ->distinct()
            ->get()
            ->map(function (Pokemon $pokemon) {
                return new FilterDTO($pokemon->habitat, $pokemon->habitat);
            })
            ->toArray();
    }
}
