<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;

use Auth;
use App\Pokemon;
use App\Trainer;

class PokemonFavoriteListController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.trainer']);
    }

    public function addPokemon()
    {
        $pokemon = Pokemon::find(request('pokemon_id'));

        if (is_null($pokemon)) {
            return response([], 422);
        }

        $trainer = Trainer::find(Auth::guard('trainer')->user()->user_id);

        if ($trainer->pokemon_favorites->contains($pokemon)) {
            return response(['message' => $pokemon->name . ' is already favorited.'], 409);
        }

        $trainer->pokemon_favorites()->save($pokemon);

        return response([], 201);
    }

    public function removePokemon()
    {
        $pokemon = Pokemon::find(request('pokemon_id'));

        if (is_null($pokemon)) {
            return response([], 422);
        }

        $trainer = Trainer::find(Auth::guard('trainer')->user()->user_id);

        if ($trainer->pokemon_favorites->contains($pokemon)) {
            $trainer->pokemon_favorites()->detach($pokemon->id);

            return response([], 204);
        }

        return response(['message' => $pokemon->name . ' is already unfavorited.'], 409);
    }
}
