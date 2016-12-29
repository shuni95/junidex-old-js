<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\EvolutionMethod;
use App\Evolution;

class ViewEvolutionChainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_evolutions_of_pokemon_that_evolves_with_only_level()
    {
        $caterpie = factory(Pokemon::class)->create(['name' => 'Caterpie']);
        $metapod = factory(Pokemon::class)->create(['name' => 'Metapod']);
        $butterfree = factory(Pokemon::class)->create(['name' => 'Butterfree']);

        $method = EvolutionMethod::create(['name' => 'by Level']);

        $caterpie_to_metapod = Evolution::create([
            'pokemon_id' => $caterpie->id,
            'evolution_id' => $metapod->id,
            'method_id' => $method->id,
            'details' => 'lvl 7'
        ]);
        $metapod_to_butterfree = Evolution::create([
            'pokemon_id' => $metapod->id,
            'evolution_id' => $butterfree->id,
            'method_id' => $method->id,
            'details' => 'lvl 10'
        ]);

        $this->visit('/evolution_chain/Butterfree')
             ->see('Caterpie evolves into Metapod at lvl 7')
             ->see('Metapod evolves into Butterfree at lvl 10');
    }

    /** @test */
    public function user_can_view_evolutions_of_pokemon_that_only_evolves_with_evolutionary_stone()
    {
        $growlithe = factory(Pokemon::class)->create(['name' => 'Growlithe']);
        $arcanine = factory(Pokemon::class)->create(['name' => 'Arcanine']);

        $method = EvolutionMethod::create(['name' => 'by evolutionary stone']);

        $growlithe_to_arcanine = Evolution::create([
            'pokemon_id' => $growlithe->id,
            'evolution_id' => $arcanine->id,
            'method_id' => $method->id,
            'details' => 'Fire Stone'
        ]);

        $this->visit('/evolution_chain/Arcanine')
             ->see('Growlithe evolves into Arcanine when exposed to a Fire Stone');
    }
}
