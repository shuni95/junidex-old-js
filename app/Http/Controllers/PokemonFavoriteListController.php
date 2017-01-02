<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Pokemon;
use App\Trainer;

class PokemonFavoriteListController extends Controller
{
    public function addPokemon()
    {
        $pokemon = Pokemon::find(request('pokemon_id'));

        if (is_null($pokemon)) {
            return response([], 422);
        }

        $user = Auth::guard('trainer')->user();

        $trainer = Trainer::find($user->id);

        $already_favorited = $trainer->pokemon_favorites->contains(function($pokemon_favorite) use ($pokemon) {
            return $pokemon_favorite->id == $pokemon->id;
        });

        if ($already_favorited) {
            return response([], 204);
        }

        $trainer->pokemon_favorites()->save($pokemon);

        return response([], 201);
    }
}
