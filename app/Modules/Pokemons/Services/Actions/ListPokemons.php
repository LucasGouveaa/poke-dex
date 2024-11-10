<?php

namespace App\Modules\Pokemons\Services\Actions;

use App\Models\Pokemon;
use App\Modules\Pokemons\DTO\ListPokemonsDTO;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

readonly class ListPokemons
{

    public function __construct(
        public ?string $name,
        public ?string $habitat,
        public ?int    $type,
        public ?string $listType,
        public int     $page,
        public int     $pageSize,
    )
    {
    }

    public function execute(): ListPokemonsDTO
    {
        $pokemons = Pokemon::query()
            ->when($this->name, fn($query) => $query->where('name', 'like', '%' . $this->name . '%'))
            ->when($this->habitat, fn($query) => $query->where('habitat', $this->habitat))
            ->when($this->listType === 'captured', fn($query) => $query->whereNotNull('user_id'))
            ->when($this->listType === 'available', fn($query) => $query->whereNull('user_id'));

        if ($this->listType === 'my-pokemon') {
            $user = JWTAuth::parseToken()->authenticate();
            $pokemons->when($user, fn($query) => $query->where('user_id', $user->id));
        }

        if ($this->type) {
            $pokemons->whereHas('types', function ($query) {
                $query->where('type_id', $this->type);
            });
        }

        $pokemons = $pokemons->paginate($this->pageSize, ['*'], 'page', $this->page);

        return new ListPokemonsDTO(
            $pokemons->items(),
            $pokemons->currentPage(),
            $pokemons->lastPage(),
            $this->pageSize,
            $pokemons->total(),
        );
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->get('name'),
            $request->get('habitat'),
            $request->get('type'),
            $request->get('listType'),
            $request->get('page') ?? 1,
            $request->get('pageSize') ?? 10
        );
    }
}
