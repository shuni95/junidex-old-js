<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Pokemon;
use App\Habitat;
use App\Pokedex;
use App\PokemonType;

use App\Http\Requests\Admin\Pokemon\AddPokemonRequest;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::withNumFavs();

        if (request('from')) {
            $pokemons->whereHas('pokedexes', function($pokedex) {
                $pokedex->where('name', request('from'));
            });
        }

        $pokemons = $pokemons->get();

        return view('admin.pokemon.index', compact('pokemons'));
    }

    public function create()
    {
        $types     = PokemonType::all()->pluck('name', 'id');
        $habitats  = Habitat::all()->pluck('name', 'id');
        $pokedexes = Pokedex::all()->pluck('name', 'id');

        return view('admin.pokemon.add', compact('types', 'pokedexes', 'habitats'));
    }

    public function store(AddPokemonRequest $request)
    {
        $new_pokemon = new Pokemon;
        $new_pokemon->name              = request('name');
        $new_pokemon->japanese_name     = request('japanese_name');
        $new_pokemon->japanese_katakana = request('japanese_katakana');
        $new_pokemon->type_one          = request('type_one');
        $new_pokemon->habitat           = request('habitat');
        $new_pokemon->type_two          = request('type_two');
        $new_pokemon->origin            = request('pokedex');
        $new_pokemon->save();

        return redirect()->route('admin.pokemon.index')->with('good_message', $new_pokemon->name . ' added to the Pokedex successfully.');
    }
}
