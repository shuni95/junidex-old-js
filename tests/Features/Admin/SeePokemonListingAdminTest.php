<?php

namespace TestZone\Features\Admin;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;
use App\Trainer;
use App\User;
use App\Pokedex;

use TestZone\Traits\ActingAs;
use TestZone\Traits\HtmlAsserts;

class SeePokemonListingAdminTest extends TestCase
{
    use DatabaseMigrations;
    use ActingAs;
    use HtmlAsserts;

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

        factory(Pokemon::class, 'charmander')->create();
        factory(Pokemon::class, 'squirtle')->create();
        factory(Pokemon::class, 'bulbasaur')->create();
        factory(Pokemon::class, 'pikachu')->create();

        $this->visit('/awesome/pokemon');

        $this->see('Fire')
             ->see('Water')
             ->see('Grass/Poison')
             ->see('Electric')
             ->see('No Favs');
    }

    /** @test */
    function admin_can_see_pokemon_belongs_to_regional_pokedex()
    {
        $this->beAdmin();
        $this->seed('PokedexSeederTest');
        $this->seed('PokedexPokemonSeederTest');

        $this->visit('/awesome/pokemon?from=Kanto');

        $this->seeMany('No Favs', 7);

        $this->visit('/awesome/pokemon?from=Hoenn');

        $this->seeMany('No Favs', 2);

        $this->visit('/awesome/pokemon');

        $this->seeMany('No Favs', 22);
    }
}
