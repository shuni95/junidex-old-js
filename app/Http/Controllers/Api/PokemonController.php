<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pokemon;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all(['name', 'type_two', 'type_one', 'japanese_name'])
                           ->makeHidden(['type_one', 'type_two']);

        return $pokemons;
    }
}
