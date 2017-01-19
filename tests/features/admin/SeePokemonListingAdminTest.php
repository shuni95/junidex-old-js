<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\Trainer;
use App\User;

class SeePokemonListingAdminTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function admin_can_see_pokemon_listing_with_quantity_of_favs_and_some_attributes()
    {
        $charmander = factory(Pokemon::class)->create(['name' => 'Charmander']);
        $charmeleon = factory(Pokemon::class)->create(['name' => 'Charmeleon']);
        $charizard  = factory(Pokemon::class)->create(['name' => 'Charizard']);

        $ash   = factory(Trainer::class, 'ash')->create();
        $alain = factory(Trainer::class, 'alain')->create();
        $gary_user  = factory(User::class)->create();
        $gary  = Trainer::create(['user_id' => $gary_user->id]);

        $ash->pokemon_favorites()->attach([$charmander->id, $charmeleon->id, $charizard->id]);
        $alain->pokemon_favorites()->attach([$charmander->id, $charmeleon->id]);
        $gary->pokemon_favorites()->attach([$charmander->id]);

        $this->visit('/awesome/pokemon/index');

        $this->see('Charmander')
             ->see('Charmeleon')
             ->see('Charizard')
             ->see('1 Fav')
             ->see('2 Favs')
             ->see('3 Favs');
    }
}
