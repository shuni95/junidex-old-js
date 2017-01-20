<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\Trainer;
use App\User;
use App\Admin;

class SeePokemonListingAdminTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    function beAdmin()
    {
        $admin = factory(Admin::class, 'admin')->create();

        $this->actingAs($admin, 'admin');
    }

    /** @test */
    function admin_can_see_pokemon_listing_with_quantity_of_favs_and_name()
    {
        $this->beAdmin();

        $charmander = factory(Pokemon::class, 'charmander')->create();
        $charmeleon = factory(Pokemon::class)->create(['name' => 'Charmeleon']);
        $charizard  = factory(Pokemon::class)->create(['name' => 'Charizard']);

        $ash   = factory(Trainer::class, 'ash')->create();
        $alain = factory(Trainer::class, 'alain')->create();
        $gary_user  = factory(User::class)->create();
        $gary  = Trainer::create(['user_id' => $gary_user->id]);

        $ash->pokemon_favorites()->attach([$charmander->id, $charmeleon->id, $charizard->id]);
        $alain->pokemon_favorites()->attach([$charmander->id, $charmeleon->id]);
        $gary->pokemon_favorites()->attach([$charmander->id]);

        $this->visit('/awesome/pokemon');

        $this->see('Charmander')
             ->see('Charmeleon')
             ->see('Charizard')
             ->see('1 Fav')
             ->see('2 Favs')
             ->see('3 Favs');
    }

    /** @test */
    function admin_can_see_pokemon_listing_its_types()
    {
        $this->beAdmin();

        $charmander = factory(Pokemon::class, 'charmander')->create();
        $squirtle   = factory(Pokemon::class, 'squirtle')->create();
        $bulbasaur  = factory(Pokemon::class, 'bulbasaur')->create();
        $pikachu    = factory(Pokemon::class, 'pikachu')->create();

        $this->visit('/awesome/pokemon');

        $this->see('Fire')
             ->see('Water')
             ->see('Grass/Poison')
             ->see('Electric');
    }
}
