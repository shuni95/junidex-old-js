<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pokemon;

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

        return view('app.pokemon.search_results', ['pokemons' => $pokemons]);
    }
}
