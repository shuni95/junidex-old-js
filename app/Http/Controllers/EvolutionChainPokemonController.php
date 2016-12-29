<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pokemon;
use App\Evolution;
use App\EvolutionaryMethodConstants;

class EvolutionChainPokemonController extends Controller
{
    protected $evolutions_array;

    public function __construct()
    {
        $this->evolutions_array = collect();
    }

    public function show($name)
    {
        $pokemon = Pokemon::where('name', $name)->first();

        $unevolved = $this->getUnevolved($pokemon);

        $this->getEvolutions($unevolved);

        return view('app.pokemon.evolution_chain', ['evolutions_array' => $this->evolutions_array]);
    }

    public function getEvolutions($pokemon)
    {
        // Verify if the pokemon has evolutions
        if ($pokemon->evolutions) {
            // See each evolution and add to the array
            foreach ($pokemon->evolutions as $evolution) {
                $this->evolutions_array->push([
                    'pokemon' => $pokemon,
                    'evolution' => $evolution->pokemon_evolution,
                    'details' => $evolution->details,
                    'linking_phrase' => $this->getLinkingPhrase($evolution),
                ]);
                // Get the evolutions of the evolution
                $this->getEvolutions($evolution->pokemon_evolution);
            }
        }
    }

    public function getUnevolved($pokemon)
    {
        // Get the evolution model where the pokemon is the evolution of a pokemon
        $evolution = Evolution::where('evolution_id', $pokemon->id)->first();
        // If the pokemon is not a evolution then return it
        if (is_null($evolution)) {
            return $pokemon;
        }
        // Else try with the pre-evolution
        return $this->getUnevolved($evolution->pokemon);
    }

    public function getLinkingPhrase($evolution)
    {
        switch ($evolution->method_id) {
            case EvolutionaryMethodConstants::LEVEL_METHOD:
                return 'at';
            case EvolutionaryMethodConstants::EVOLUTIONARY_STONE_METHOD:
                return 'when exposed to a';
        }
    }
}
