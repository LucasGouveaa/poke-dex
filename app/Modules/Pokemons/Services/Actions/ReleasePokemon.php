<?php

namespace App\Modules\Pokemons\Services\Actions;


use App\Models\Pokemon;
use App\Models\User;

readonly class ReleasePokemon
{
    public function __construct(
        public int  $pokemonId,
        public User $user,
    )
    {
    }

    public function execute(): array
    {
        /**
         * @var Pokemon $pokemon
         */
        $pokemon = Pokemon::find($this->pokemonId);

        if (!$pokemon) {
            return [
                'success' => false,
                'message' => 'Pokemon não encontrado!'
            ];
        }

        if (!$pokemon->user_id) {
            return [
                'success' => false,
                'message' => 'Pokemon sem treinador!'
            ];
        }

        if ($pokemon->user_id !== $this->user->id) {
            return [
                'success' => false,
                'message' => 'Pokemon de outro treinador!'
            ];
        }

        $pokemon->user_id = null;
        $pokemon->save();

        return [
            'success' => true,
            'message' => 'Pokemon soltado com sucesso!'
        ];
    }
}
