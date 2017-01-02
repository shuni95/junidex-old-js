<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Pokemon;

class PokemonFavoriteListController extends Controller
{
    public function addPokemon()
    {
        $pokemon = Pokemon::find(request('pokemon_id'));

        $trainer = Auth::guard('trainer')->user()->trainer;

        $trainer->pokemon_favorites()->save($pokemon);

        return response([], 201);
    }
}
