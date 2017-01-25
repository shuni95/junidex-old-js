<?php

namespace TestZone\Features;

use TestZone\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Trainer;
use App\Pokemon;

class FavoritePokemonTest extends TestCase
{
    use DatabaseMigrations;

    protected $number_of_favorites;

    function reloadTrainer(&$trainer)
    {
        $trainer = Trainer::find($trainer->user_id);
    }

    /** @test */
    function trainer_can_favorite_a_pokemon()
    {
        $ash     = factory(Trainer::class, 'ash')->create();
        $pikachu = factory(Pokemon::class, 'pikachu')->create();

        $this->actingAs($ash, 'trainer');

        $this->assertTrue($ash->pokemon_favorites->count() == 0);

        $this->call('POST', '/trainers/favorites/add', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(201);

        $this->reloadTrainer($ash);

        $this->assertTrue($ash->pokemon_favorites->contains($pikachu));
    }

    /** @test */
    function trainer_cannot_favorite_a_non_existent_pokemon()
    {
        $ash     = factory(Trainer::class, 'ash')->create();
        $pikachu = factory(Pokemon::class, 'pikachu')->make();

        $this->actingAs($ash, 'trainer');

        $this->assertTrue($ash->pokemon_favorites->count() == 0);

        $this->call('POST', '/trainers/favorites/add', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(422);

        $this->assertFalse($ash->pokemon_favorites->contains($pikachu));
    }

    /** @test */
    function trainer_cannot_favorite_a_pokemon_twice()
    {
        $ash     = factory(Trainer::class, 'ash')->create();
        $pikachu = factory(Pokemon::class, 'pikachu')->create();

        $this->actingAs($ash, 'trainer');

        $this->call('POST', '/trainers/favorites/add', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(201);

        $this->reloadTrainer($ash);

        $this->assertTrue($ash->pokemon_favorites->count() == 1);

        $this->call('POST', '/trainers/favorites/add', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(409);

        $this->reloadTrainer($ash);

        $this->assertTrue($ash->pokemon_favorites->count() == 1);
    }

    /** @test */
    function trainer_can_unfavorite_a_pokemon()
    {
        $ash     = factory(Trainer::class, 'ash')->create();
        $pikachu = factory(Pokemon::class, 'pikachu')->create();

        $this->actingAs($ash, 'trainer');

        $this->call('POST', '/trainers/favorites/add', ['pokemon_id' => $pikachu->id]);

        $this->assertTrue($ash->pokemon_favorites->count() == 1);

        $this->call('DELETE', '/trainers/favorites/remove', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(204);

        $this->reloadTrainer($ash);

        $this->assertTrue($ash->pokemon_favorites->count() == 0);

        $this->assertFalse($ash->pokemon_favorites->contains($pikachu));
    }
}
