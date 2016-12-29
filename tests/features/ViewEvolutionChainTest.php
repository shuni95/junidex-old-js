<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;

class ViewEvolutionChainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_evolutions_of_pokemon_that_evolves_with_only_level()
    {
        $caterpie = factory(Pokemon::class)->create(['Caterpie']);
        $metapod = factory(Pokemon::class)->create(['Metapod']);
        $butterfree = factory(Pokemon::class)->create(['Butterfree']);

        $caterpie->evolutions()->save($metapod);
        $metapod->evolutions()->save($butterfree);

        $this->visit('/evolution_chain?pokemon=Caterpie')
             ->see('Caterpie')
             ->see('Metapod')
             ->see('Butterfree');

        $this->visit('/evolution_chain?pokemon=Metapod')
             ->see('Caterpie')
             ->see('Metapod')
             ->see('Butterfree');

        $this->visit('/evolution_chain?pokemon=Butterfree')
             ->see('Caterpie')
             ->see('Metapod')
             ->see('Butterfree');
    }
}
