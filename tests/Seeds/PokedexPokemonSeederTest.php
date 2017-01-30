<?php

use Illuminate\Database\Seeder;

use App\Pokedex;
use App\Pokemon;

class PokedexPokemonSeederTest extends Seeder
{
    public function run()
    {
        $pokedexes = Pokedex::all();

        $byName = function($name) {
            return function($pokemon) use ($name) { return $pokemon->name == $name; };
        };

        $kanto = $pokedexes->first($byName('Kanto'));
        $hoenn = $pokedexes->first($byName('Hoenn'));
        $johto = $pokedexes->first($byName('Johto'));
        $alola = $pokedexes->first($byName('Alola'));

        $position = 0;

        $setPosition = function($pokemon) use(&$position) {
            return ['pokemon_id' => $pokemon->id, 'position' => ++$position];
        };

        $kanto->pokemons()->attach(factory(Pokemon::class, 7)->create()->map($setPosition)->keyBy('pokemon_id')->toArray());
        $johto->pokemons()->attach(factory(Pokemon::class, 4)->create()->map($setPosition)->keyBy('pokemon_id')->toArray());
        $hoenn->pokemons()->attach(factory(Pokemon::class, 2)->create()->map($setPosition)->keyBy('pokemon_id')->toArray());
        $alola->pokemons()->attach(factory(Pokemon::class, 9)->create()->map($setPosition)->keyBy('pokemon_id')->toArray());
    }
}