<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddPokemonAdminTest extends TestCase
{
    /** @test */
    function admin_can_add_a_new_pokemon()
    {
        $this->visit('/awesome/pokemon/add');

        $this->type('Rowlet', 'name')
             ->type('Mukuroh', 'japanese_name')
             ->type('モクロー', 'japanese_katakana')
             ->select('Grass', 'type_one')
             ->select('Flying', 'type_two')
             ->select('Unknown', 'habitat')
             ->press('Add to Pokedex');

        $this->seePageIs('/awesome/pokemon/index')
             ->see('Rowlet')
             ->see('Grass/Flying')
             ->see('Rowlet added to the Pokedex successfully.');
    }
}
