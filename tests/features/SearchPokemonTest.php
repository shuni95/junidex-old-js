<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchPokemonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_some_pokemon_in_the_search_results()
    {
        // Data
        $pokemonA = Pokemon::create(['name' => 'Charmander',]);
        $pokemonB = Pokemon::create(['name' => 'Charizard',]);
        $pokemonC = Pokemon::create(['name' => 'Psyduck',]);

        // Process
        $this->visit('/searchPokemon?name=A');

        // Validar
        $this->see('Charmander');
        $this->see('Charizard');
        $this->dontSee('Psyduck');
    }
}
