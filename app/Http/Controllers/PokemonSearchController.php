<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pokemon;

use Auth;

class PokemonSearchController extends Controller
{
    public function index()
    {
        $pokemons = new Pokemon;

        if (request('name')) {
            $pokemons = $pokemons->searchByName();
        }

        if (request('type')) {
            $pokemons = $pokemons->searchByType();
        }

        if (request('habitat')) {
            $pokemons = $pokemons->searchByHabitat();
        }

        if (request('egg_group')) {
            $pokemons = $pokemons->searchByEggGroup();
        }

        $pokemons = $pokemons->get();

        $trainer = Auth::guard('trainer')->user();

        if ($trainer && $trainer->pokemon_favorites->count() > 0) {
            $pokemons = $pokemons->each(function($pokemon) use ($trainer) {
                $pokemon->is_favorite = $trainer->pokemon_favorites->contains($pokemon);
            });
        }

        return view('app.pokemon.search_results', ['pokemons' => $pokemons]);
    }
}
