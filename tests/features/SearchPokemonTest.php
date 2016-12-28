<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;

class SearchPokemonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name()
    {
        $pokemonA = Pokemon::create(['name' => 'Charmander',]);
        $pokemonB = Pokemon::create(['name' => 'Charizard',]);
        $pokemonC = Pokemon::create(['name' => 'Psyduck',]);

        $this->visit('/searchPokemon?name=Char');
        $this->see('Charmander');
        $this->see('Charizard');
        $this->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=Psy');
        $this->dontSee('Charmander');
        $this->dontSee('Charizard');
        $this->see('Psyduck');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_in_lowercase()
    {
        $pokemonA = Pokemon::create(['name' => 'Charmander',]);
        $pokemonB = Pokemon::create(['name' => 'Charizard',]);
        $pokemonC = Pokemon::create(['name' => 'Psyduck',]);

        $this->visit('/searchPokemon?name=char');
        $this->see('Charmander');
        $this->see('Charizard');
        $this->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=psy');
        $this->dontSee('Charmander');
        $this->dontSee('Charizard');
        $this->see('Psyduck');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_in_uppercase()
    {
        $pokemonA = Pokemon::create(['name' => 'Charmander',]);
        $pokemonB = Pokemon::create(['name' => 'Charizard',]);
        $pokemonC = Pokemon::create(['name' => 'Psyduck',]);

        $this->visit('/searchPokemon?name=CHAR');
        $this->see('Charmander');
        $this->see('Charizard');
        $this->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=PSY');
        $this->dontSee('Charmander');
        $this->dontSee('Charizard');
        $this->see('Psyduck');
    }

}
