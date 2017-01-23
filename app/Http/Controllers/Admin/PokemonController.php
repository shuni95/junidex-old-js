<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Pokemon;

use App\Http\Requests\Admin\Pokemon\AddPokemonRequest;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::withNumFavs()->get();

        return view('admin.pokemon.index', compact('pokemons'));
    }

    public function create()
    {
        $types = [
            'Grass',
            'Fire',
            'Water',
            'Electric',
            'Flying',
            'Ice',
            'Dragon',
            'Steel',
            'Poison',
            'Bug',
            'Psychic',
            'Ghost',
            'Fairy',
            'Dark',
            'Fighting',
            'Normal',
            'Ground',
            'Rock',
        ];

        return view('admin.pokemon.add', compact('types'));
    }

    public function store(AddPokemonRequest $request)
    {
        $new_pokemon = Pokemon::create(request()->all());

        return redirect()->route('admin.pokemon.index')->with('good_message', $new_pokemon->name . ' added to the Pokedex successfully.');
    }
}
