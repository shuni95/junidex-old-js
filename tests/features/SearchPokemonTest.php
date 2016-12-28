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
        factory(Pokemon::class)->create(['name' => 'Charmander']);
        factory(Pokemon::class)->create(['name' => 'Charizard']);
        factory(Pokemon::class)->create(['name' => 'Psyduck']);

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
        factory(Pokemon::class)->create(['name' => 'Charmander']);
        factory(Pokemon::class)->create(['name' => 'Charizard']);
        factory(Pokemon::class)->create(['name' => 'Psyduck']);

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
        factory(Pokemon::class)->create(['name' => 'Charmander']);
        factory(Pokemon::class)->create(['name' => 'Charizard']);
        factory(Pokemon::class)->create(['name' => 'Psyduck']);

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
        factory(Pokemon::class)->create(['japanese_name' => 'Hitokage']);
        factory(Pokemon::class)->create(['japanese_name' => 'Lizardon']);
        factory(Pokemon::class)->create(['japanese_name' => 'Koduck']);

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
        factory(Pokemon::class)->create(['japanese_katakana' => 'ヒトカゲ']);
        factory(Pokemon::class)->create(['japanese_katakana' => 'リザードン']);
        factory(Pokemon::class)->create(['japanese_katakana' => 'コダック']);

        $this->visit('/searchPokemon?name=リザー')
             ->see('リザードン')
             ->dontSee('コダック');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_the_pokemon_type()
    {
        factory(Pokemon::class)->create(['name' => 'Charmander', 'type_one' => 'Fire']);
        factory(Pokemon::class)->create(['name' => 'Charizard', 'type_one' => 'Fire','type_two' => 'Flying']);
        factory(Pokemon::class)->create(['name' => 'Psyduck', 'type_one' => 'Water']);
        factory(Pokemon::class)->create(['name' => 'Squirtle', 'type_one' => 'Water']);
        factory(Pokemon::class)->create(['name' => 'Arceus', 'type_one' => 'Normal']);

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
        factory(Pokemon::class)->create(['name' => 'Pikachu', 'habitat' => 'Forest']);
        factory(Pokemon::class)->create(['name' => 'Metapod', 'habitat' => 'Forest']);
        factory(Pokemon::class)->create(['name' => 'Dratini', 'habitat' => 'Fresh Water']);

        $this->visit('/searchPokemon?habitat=Forest')
             ->see('Pikachu')
             ->see('Metapod')
             ->dontSee('Dratini');
    }

    /** @test */
    public function user_can_view_pokemon_in_the_results_using_part_of_the_name_and_type()
    {
        factory(Pokemon::class)->create(['name' => 'Charmander', 'type_one' => 'Fire']);
        factory(Pokemon::class)->create(['name' => 'Charizard', 'type_one' => 'Fire','type_two' => 'Flying']);
        factory(Pokemon::class)->create(['name' => 'Psyduck', 'type_one' => 'Water']);
        factory(Pokemon::class)->create(['name' => 'Squirtle', 'type_one' => 'Water']);
        factory(Pokemon::class)->create(['name' => 'Arceus', 'type_one' => 'Normal']);
        factory(Pokemon::class)->create(['name' => 'Arcanine', 'type_one' => 'Fire']);

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

    //Egg group
}
