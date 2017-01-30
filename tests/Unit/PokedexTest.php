<?php

namespace TestZone\Unit;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokedex;

class PokedexTest extends TestCase
{
    use DatabaseMigrations;

    function setUp()
    {
        parent::setUp();
        $this->seed('PokedexSeederTest');
    }
    /** @test */
    function test_order_asc_by_num_pokemon()
    {
        $this->seed('PokedexPokemonSeederTest');

        $pokedexes = Pokedex::select(\DB::raw('pokedexes.*, count(pokedex_pokemon.pokedex_id) as num_pokemon'))
            ->leftJoin('pokedex_pokemon',
                   'pokedexes.id', '=', 'pokedex_pokemon.pokedex_id')
            ->groupBy('pokedexes.id')
            ->orderBy('num_pokemon')
            ->get();

        $this->assertTrue($pokedexes->first()->name == 'Hoenn');
        $this->assertTrue($pokedexes->last()->name  == 'Alola');
    }
}
