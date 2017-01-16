<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Pokemon;
use App\Trainer;

class PokemonFavoriteListController extends Controller
{
    protected $user_id;

    public function __construct()
    {
        $this->middleware(['auth.trainer']);
        $this->user_id = Auth::guard('trainer')->user()->user_id;
    }

    public function addPokemon()
    {
        $pokemon = Pokemon::find(request('pokemon_id'));

        if (is_null($pokemon)) {
            return response([], 422);
        }

        $trainer = Trainer::find($this->user_id);

        if ($trainer->pokemon_favorites->contains($pokemon)) {
            return response(['message' => $pokemon->name . ' is already favorited.'], 409);
        }

        $trainer->pokemon_favorites()->save($pokemon);

        return response([], 201);
    }
}
