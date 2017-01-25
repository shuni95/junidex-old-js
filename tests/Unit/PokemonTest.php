<?php

namespace TestZone\Unit;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\Trainer;
use App\User;

class PokemonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function order_asc_by_num_favs()
    {
        $charmeleon = factory(Pokemon::class)->create(['name' => 'Charmeleon']);
        $charizard  = factory(Pokemon::class)->create(['name' => 'Charizard']);
        $charmander = factory(Pokemon::class)->create(['name' => 'Charmander']);

        $ash   = factory(Trainer::class, 'ash')->create();
        $alain = factory(Trainer::class, 'alain')->create();
        $gary_user  = factory(User::class)->create();
        $gary  = Trainer::create(['user_id' => $gary_user->id]);

        $ash->pokemon_favorites()->attach([$charmander->id, $charmeleon->id, $charizard->id]);
        $alain->pokemon_favorites()->attach([$charmander->id, $charmeleon->id]);
        $gary->pokemon_favorites()->attach([$charmander->id]);

        $pokemons = Pokemon::orderByFavs()->get();

        $this->assertTrue($pokemons->first()->id == $charizard->id);
        $this->assertTrue($pokemons->last()->id  == $charmander->id);
    }

    /** @test */
    function order_desc_by_num_favs()
    {
        $charmeleon = factory(Pokemon::class)->create(['name' => 'Charmeleon']);
        $charizard  = factory(Pokemon::class)->create(['name' => 'Charizard']);
        $charmander = factory(Pokemon::class)->create(['name' => 'Charmander']);

        $ash   = factory(Trainer::class, 'ash')->create();
        $alain = factory(Trainer::class, 'alain')->create();
        $gary_user  = factory(User::class)->create();
        $gary  = Trainer::create(['user_id' => $gary_user->id]);

        $ash->pokemon_favorites()->attach([$charmander->id, $charmeleon->id, $charizard->id]);
        $alain->pokemon_favorites()->attach([$charmander->id, $charmeleon->id]);
        $gary->pokemon_favorites()->attach([$charmander->id]);

        $pokemons = Pokemon::orderByFavs('desc')->get();

        $this->assertTrue($pokemons->first()->id == $charmander->id);
        $this->assertTrue($pokemons->last()->id  == $charizard->id);
    }
}
