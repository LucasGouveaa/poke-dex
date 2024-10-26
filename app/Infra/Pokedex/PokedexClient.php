<?php

namespace App\Infra\Pokedex;

use App\Models\Pokemon;
use App\Models\Type;
use App\Modules\Pokemons\DTO\PokemonDTO;
use App\Support\StringUtil;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

readonly class PokedexClient implements Infra\PokedexClientInterface
{

    public function __construct(
        private PendingRequest $client,
    )
    {
    }

    /**
     * @throws ConnectionException
     */
    public function createOrUpdatePokemons(): void
    {
        $offSet = 0;
        $limit = 500;

        do {
            $response = $this->client->get("/pokemon?limit=$limit&offset=$offSet");
            $response = $response->json();
            $offSet += $limit;

            foreach ($response['results'] as $result) {
                DB::beginTransaction();

                try {
                    Log::info("Criando pokemon {$result['name']}");

                    $responsePokemon = $this->client->get("/pokemon/" . $result['name']);
                    $pokemonDto = PokemonDTO::fromArray($responsePokemon->json());

                    $pokemon = Pokemon::query()->where('external_id', $pokemonDto->id)->first();
                    if (!$pokemon) {
                        $pokemon = new Pokemon();
                        $pokemon->external_id = $pokemonDto->id;
                    }

                    $pokemon->fill($pokemonDto->toArray());

                    $responseSpecies = $this->client->get("/pokemon-species/" . $result['name']);
                    $responseSpecies = $responseSpecies->json();

                    $pokemon->habitat = isset($responseSpecies['habitat']['name']) ? StringUtil::ucFirstPhrase($responseSpecies['habitat']['name'],'-'):  null;
                    $pokemon->save();

                    foreach ($pokemonDto->types as $type) {
                        $responseType = $this->client->get("/type/" . $type['type']['name']);
                        $responseType = $responseType->json();

                        $type = Type::query()->where("external_id", $responseType['id'])->first();
                        if (!$type) {
                            $type = new Type();
                            $type->external_id = $responseType['id'];
                        }

                        $type->name = StringUtil::ucFirstPhrase($responseType['name']);
                        $type->img_url = $responseType['sprites']['generation-viii']['sword-shield']['name_icon'] ?? null;
                        $type->save();
                    }

                    DB::commit();

                } catch (ConnectionException $e) {
                    DB::rollBack();
                    Log::error($e->getMessage());
                }
            }

        } while (count($response['results']) > 0);
    }
}
