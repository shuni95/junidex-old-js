<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Pokemon;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::with('owner_favorites')->get();

        return view('admin.pokemon.index', compact('pokemons'));
    }
}
