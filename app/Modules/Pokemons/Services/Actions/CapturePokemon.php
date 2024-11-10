<?php

namespace App\Modules\Pokemons\Services\Actions;


use App\Models\Pokemon;
use App\Models\User;

readonly class CapturePokemon
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

        if ($pokemon->user_id) {

            if ($pokemon->user_id === $this->user->id) {
                return [
                    'success' => false,
                    'message' => 'Você já possui esse pokemon!'
                ];
            }

            return [
                'success' => false,
                'message' => 'Pokemon já capturado!'
            ];
        }

        if ($this->user->pokemons()->count() >= 3) {
            return [
                'success' => false,
                'message' => 'Limite de pokemons excedido!'
            ];
        }

        $pokemon->user_id = $this->user->id;
        $pokemon->save();

        return [
            'success' => true,
            'message' => 'Pokemon capturado com sucesso!'
        ];
    }
}
