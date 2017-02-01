<?php

namespace TestZone\Features;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\PokemonType;
use App\EggGroup;

class SearchPokemonTest extends TestCase
{
    use DatabaseMigrations;

    function setUp()
    {
        parent::setUp();
        $this->seed('PokemonTypeSeeder');
        $this->seed('PokemonSeederTest');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name()
    {
        $this->visit('/searchPokemon?name=Char')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=Psy')
             ->see('Psyduck')
             ->dontSee('Charmander')
             ->dontSee('Charizard');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_in_lowercase()
    {
        $this->visit('/searchPokemon?name=char')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=psy')
             ->dontSee('Charmander')
             ->dontSee('Charizard')
             ->see('Psyduck');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_in_uppercase()
    {
        $this->visit('/searchPokemon?name=CHAR')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=PSY')
             ->dontSee('Charmander')
             ->dontSee('Charizard')
             ->see('Psyduck');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_japanese_name()
    {
        $this->visit('/searchPokemon?name=Hito')
             ->see('Hitokage')
             ->dontSee('Lizardon');

        $this->visit('/searchPokemon?name=Liza')
             ->see('Lizardon')
             ->dontSee('Koduck');

        $this->visit('/searchPokemon?name=Kod')
             ->see('Koduck')
             ->dontSee('Hitokage');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_japanese_katakana()
    {
        $this->visit('/searchPokemon?name=リザー')
             ->see('リザードン')
             ->dontSee('コダック');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_the_pokemon_type()
    {
        $this->visit('/searchPokemon?type=Fire')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus');

        $this->visit('/searchPokemon?type=Flying')
             ->see('Charizard')
             ->dontSee('Charmander')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_the_habitat()
    {
        $this->visit('/searchPokemon?habitat=Forest')
             ->see('Pikachu')
             ->see('Metapod')
             ->dontSee('Dratini');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_and_type()
    {
        $this->visit('/searchPokemon?name=Char&type=Fire')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus')
             ->dontSee('Arcanine');

        $this->visit('/searchPokemon?name=Arc&type=Water')
             ->dontSee('Charmander')
             ->dontSee('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus')
             ->dontSee('Arcanine');

        $this->visit('/searchPokemon?name=Arc&type=Fire')
             ->dontSee('Charmander')
             ->dontSee('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus')
             ->see('Arcanine');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_and_habitat()
    {
        $this->visit('/searchPokemon?name=arc&habitat=Meadow')
             ->dontSee('Charmander')
             ->dontSee('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus')
             ->see('Arcanine');

        $this->visit('/searchPokemon?name=C&habitat=Mountain')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Arceus')
             ->dontSee('Arcanine');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_type_and_habitat()
    {
        $this->visit('/searchPokemon?type=Fire&habitat=Mountain')
             ->see('Charmander')
             ->see('Charizard')
             ->dontSee('Psyduck')
             ->dontSee('Squirtle')
             ->dontSee('Lapras')
             ->dontSee('Arcanine');

        $this->visit('/searchPokemon?type=Water&habitat=Fresh Water')
             ->dontSee('Charmander')
             ->dontSee('Charizard')
             ->see('Psyduck')
             ->see('Squirtle')
             ->dontSee('Lapras')
             ->dontSee('Arcanine');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_egg_group()
    {
        $this->seed('EggGroupSeederTest');

        factory(Pokemon::class)->create(['name' => 'Pikachu'])->egg_groups()->sync([1, 2]);

        factory(Pokemon::class)->create(['name' => 'Metapod'])->egg_groups()->sync([3]);

        factory(Pokemon::class)->create(['name' => 'Dratini'])->egg_groups()->sync([4, 5]);

        $this->visit('/searchPokemon?egg_group=Field')
             ->see('Pikachu')
             ->dontSee('Metapod')
             ->dontSee('Dratini');
    }

}
