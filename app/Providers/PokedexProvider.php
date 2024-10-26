<?php

namespace App\Providers;

use App\Infra\Pokedex\Infra\PokedexClientInterface;
use App\Infra\Pokedex\PokedexClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class PokedexProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PokedexClientInterface::class, function ($app) {
            $http = Http::baseUrl(Config('services.pokedex.base_url'))
                ->withHeaders(['Content-Type' => 'application/json']);

            return new PokedexClient($http);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
