<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\EvolutionMethod;
use App\Evolution;
use App\EvolutionaryMethodConstants;

class ViewEvolutionChainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_evolutions_of_pokemon_that_evolves_with_only_level()
    {
        $caterpie = factory(Pokemon::class)->create(['name' => 'Caterpie']);
        $metapod = factory(Pokemon::class)->create(['name' => 'Metapod']);
        $butterfree = factory(Pokemon::class)->create(['name' => 'Butterfree']);

        $method = EvolutionMethod::create(['id' => EvolutionaryMethodConstants::LEVEL_METHOD, 'name' => 'by Level']);

        Evolution::create(['pokemon_id' => $caterpie->id, 'evolution_id' => $metapod->id, 'method_id' => $method->id, 'details' => 'lvl 7']);
        Evolution::create(['pokemon_id' => $metapod->id, 'evolution_id' => $butterfree->id, 'method_id' => $method->id, 'details' => 'lvl 10']);

        $this->visit('/evolution_chain/Butterfree')
             ->see('Caterpie evolves into Metapod at lvl 7')
             ->see('Metapod evolves into Butterfree at lvl 10');
    }

    /** @test */
    public function user_can_view_evolutions_of_pokemon_that_only_evolves_with_evolutionary_stone()
    {
        $growlithe = factory(Pokemon::class)->create(['name' => 'Growlithe']);
        $arcanine = factory(Pokemon::class)->create(['name' => 'Arcanine']);

        $method = EvolutionMethod::create(['id' => EvolutionaryMethodConstants::EVOLUTIONARY_STONE_METHOD, 'name' => 'by evolutionary stone']);

        Evolution::create([
            'pokemon_id' => $growlithe->id,
            'evolution_id' => $arcanine->id,
            'method_id' => $method->id,
            'details' => 'Fire Stone'
        ]);

        $this->visit('/evolution_chain/Arcanine')
             ->see('Growlithe evolves into Arcanine when exposed to a Fire Stone');
    }

    /** @test */
    public function user_can_view_evolutions_of_pokemon_that_evolves_with_level_and_megastone()
    {
        $charmander = factory(Pokemon::class)->create(['name' => 'Charmander']);
        $charmeleon = factory(Pokemon::class)->create(['name' => 'Charmeleon']);
        $charizard = factory(Pokemon::class)->create(['name' => 'Charizard']);
        $mega_charizard_x = factory(Pokemon::class)->create(['name' => 'Mega Charizard X']);
        $mega_charizard_y = factory(Pokemon::class)->create(['name' => 'Mega Charizard Y']);

        $level_method = EvolutionMethod::create(['id' => EvolutionaryMethodConstants::LEVEL_METHOD, 'name' => 'by Level']);
        $mega_stone_method = EvolutionMethod::create(['id' => EvolutionaryMethodConstants::MEGASTONE_METHOD, 'name' => 'using']);

        Evolution::create(['pokemon_id' => $charmander->id, 'evolution_id' => $charmeleon->id, 'method_id' => $level_method->id, 'details' => 'lvl 16']);
        Evolution::create(['pokemon_id' => $charmeleon->id, 'evolution_id' => $charizard->id, 'method_id' => $level_method->id, 'details' => 'lvl 36']);
        Evolution::create(['pokemon_id' => $charizard->id, 'evolution_id' => $mega_charizard_x->id, 'method_id' => $mega_stone_method->id, 'details' => 'Charizardite X']);
        Evolution::create(['pokemon_id' => $charizard->id, 'evolution_id' => $mega_charizard_y->id, 'method_id' => $mega_stone_method->id, 'details' => 'Charizardite Y']);

        $this->visit('/evolution_chain/Charizard')
             ->see('Charmander evolves into Charmeleon at lvl 16')
             ->see('Charmeleon evolves into Charizard at lvl 36')
             ->see('Charizard evolves into Mega Charizard X using Charizardite X')
             ->see('Charizard evolves into Mega Charizard Y using Charizardite Y');
    }
}
