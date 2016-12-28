<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pokemon;

class PokemonSearchController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::searchByName()->get();

        return view('app.pokemon.search_results', ['pokemons' => $pokemons]);
    }
}
