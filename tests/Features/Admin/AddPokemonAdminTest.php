<?php

namespace TestZone\Features\Admin;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use TestZone\Traits\ActingAs;
use TestZone\Traits\HtmlAsserts;

class AddPokemonAdminTest extends TestCase
{
    use DatabaseMigrations;
    use ActingAs;
    use HtmlAsserts;

    function setUp()
    {
        parent::setUp();
        $this->seed('PokemonTypeSeeder');
        $this->seed('PokedexSeeder');
    }

    /** @test */
    function admin_can_add_a_new_pokemon()
    {
        $this->beAdmin();

        $this->visit('/awesome/pokemon/add');

        $this->type('Rowlet', 'name')
             ->type('Mukuroh', 'japanese_name')
             ->type('モクロー', 'japanese_katakana')
             ->select('Grass', 'type_one')
             ->select('Flying', 'type_two')
             ->select('Unknown', 'habitat')
             ->select('Alola', 'pokedex')
             ->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon')
             ->see('Rowlet')
             ->see('Grass/Flying')
             ->see('Rowlet added to the Pokedex successfully.');
    }

    /** @test */
    function admin_must_fill_all_fields()
    {
        $this->beAdmin();

        $this->visit('/awesome/pokemon/add');

        $this->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon/add')
             ->see('Name is required')
             ->see('Japanese Name is required')
             ->see('Japanase Katakana is required')
             ->see('At least select one type')
             ->see('Pokedex origin is required');
    }

    /** @test */
    function admin_can_see_old_input_whether_form_fails()
    {
        $this->beAdmin();

        $this->visit('/awesome/pokemon/add');

        $this->type('Rowlet', 'name')
             ->type('Mukuroh', 'japanese_name')
             ->select('Grass', 'type_one')
             ->select('Flying', 'type_two')
             ->select('Unknown', 'habitat')
             ->select('Alola', 'pokedex')
             ->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon/add')
             ->see('Rowlet')
             ->see('Mukuroh')
             ->seeIsSelected('type_one', 'Grass')
             ->dontSeeIsSelected('type_one', 'Fire')
             ->seeIsSelected('pokedex', 'Alola');
    }
}
