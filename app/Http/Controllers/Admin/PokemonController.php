<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Pokemon;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::withNumFavs()->get();

        return view('admin.pokemon.index', compact('pokemons'));
    }

    public function create()
    {
        return view('admin.pokemon.add');
    }

    public function store()
    {
        $new_pokemon = Pokemon::create(request()->all());

        return redirect()->route('admin.pokemon.index')->with('good_message', $new_pokemon->name . ' added to the Pokedex successfully.');
    }
}
