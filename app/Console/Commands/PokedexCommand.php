<?php

namespace App\Console\Commands;

use App\Infra\Pokedex\Infra\PokedexClientInterface;
use Illuminate\Console\Command;

class PokedexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pokedex-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private PokedexClientInterface $pokedexClient;

    public function __construct()
    {
        parent::__construct();
        $this->pokedexClient = app(PokedexClientInterface::class);
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->pokedexClient->createOrUpdatePokemons();
    }
}
