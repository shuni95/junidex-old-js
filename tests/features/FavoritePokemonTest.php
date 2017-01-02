<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;
use App\Pokemon;

class FavoritePokemonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function testExample()
    {
        $ash = factory(User::class, 'ash')->create();
        Trainer::create(['user_id' => $ash->id]);

        $pikachu = factory(Pokemon::class, 'pikachu')->create();

        $this->actingAs($ash, 'trainer');

        $this->assertTrue($ash->pokemon_favorites->isEmpty());

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertTrue($ash->pokemon_favorites->contains(function ($pokemon) use ($pikachu) {
            return $pokemon->id == $pikachu->id;
        }));
    }
}
