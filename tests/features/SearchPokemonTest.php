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
        $pokemonA = factory(Pokemon::class)->create(['name' => 'Charmander']);
        $pokemonB = factory(Pokemon::class)->create(['name' => 'Charizard']);
        $pokemonC = factory(Pokemon::class)->create(['name' => 'Psyduck']);

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
        $pokemonA = factory(Pokemon::class)->create(['name' => 'Charmander']);
        $pokemonB = factory(Pokemon::class)->create(['name' => 'Charizard']);
        $pokemonC = factory(Pokemon::class)->create(['name' => 'Psyduck']);

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
        $pokemonA = factory(Pokemon::class)->create(['name' => 'Charmander']);
        $pokemonB = factory(Pokemon::class)->create(['name' => 'Charizard']);
        $pokemonC = factory(Pokemon::class)->create(['name' => 'Psyduck']);

        $this->visit('/searchPokemon?name=CHAR');
        $this->see('Charmander');
        $this->see('Charizard');
        $this->dontSee('Psyduck');

        $this->visit('/searchPokemon?name=PSY');
        $this->dontSee('Charmander');
        $this->dontSee('Charizard');
        $this->see('Psyduck');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_japanese_name()
    {
        $pokemonA = factory(Pokemon::class)->create(['japanese_name' => 'Hitokage']);
        $pokemonB = factory(Pokemon::class)->create(['japanese_name' => 'Lizardon']);
        $pokemonC = factory(Pokemon::class)->create(['japanese_name' => 'Koduck']);

        $this->visit('/searchPokemon?name=Hito');
        $this->see('Hitokage');
        $this->dontSee('Lizardon');

        $this->visit('/searchPokemon?name=Liza');
        $this->see('Lizardon');
        $this->dontSee('Koduck');

        $this->visit('/searchPokemon?name=Kod');
        $this->see('Koduck');
        $this->dontSee('Hitokage');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_japanese_katakana()
    {
        $pokemonA = factory(Pokemon::class)->create(['japanese_katakana' => 'ヒトカゲ']);
        $pokemonB = factory(Pokemon::class)->create(['japanese_katakana' => 'リザードン']);
        $pokemonC = factory(Pokemon::class)->create(['japanese_katakana' => 'コダック']);

        $this->visit('/searchPokemon?name=リザー');

        $this->see('リザードン');
        $this->dontSee('コダック');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_the_pokemon_type()
    {
        $pokemonA = factory(Pokemon::class)->create(['name' => 'Charmander', 'type_one' => FIRE_TYPE]);
        $pokemonB = factory(Pokemon::class)->create(['name' => 'Charizard', 'type_one' => FIRE_TYPE,'type_two' => FLYING_TYPE ]);
        $pokemonC = factory(Pokemon::class)->create(['name' => 'Psyduck', 'type_one' => WATER_TYPE]);
        $pokemonD = factory(Pokemon::class)->create(['name' => 'Squirtle', 'type_one' => WATER_TYPE]);
        $pokemonE = factory(Pokemon::class)->create(['name' => 'Arceus', 'type_one' => NORMAL_TYPE]);

        $this->visit('/searchPokemon?type=Fire');

        $this->see('Charmander');
        $this->see('Charizard');
    }
}
