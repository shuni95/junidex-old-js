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
    use WithoutMiddleware;

    /** @test */
    public function trainer_can_favorite_a_pokemon()
    {
        $ash = factory(User::class, 'ash')->create();
        $ash_trainer = Trainer::create(['user_id' => $ash->id]);

        $pikachu = factory(Pokemon::class)->create(['name' => 'Pikachu']);

        $this->actingAs($ash, 'trainer');

        $this->assertTrue($ash_trainer->pokemon_favorites->isEmpty());

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(201);

        $ash_trainer = Trainer::find($ash_trainer->user_id);

        $this->assertTrue($ash_trainer->pokemon_favorites->contains(function ($pokemon) use ($pikachu) {
            return $pokemon->id == $pikachu->id;
        }));
    }

    /** @test */
    public function trainer_cannot_favorite_a_non_existent_pokemon()
    {
        $ash = factory(User::class, 'ash')->create();
        $ash_trainer = Trainer::create(['user_id' => $ash->id]);

        $pikachu = factory(Pokemon::class)->make(['name' => 'Pikachu']);

        $this->actingAs($ash, 'trainer');

        $this->assertTrue($ash_trainer->pokemon_favorites->isEmpty());

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(422);

        $ash_trainer = Trainer::find($ash_trainer->user_id);

        $this->assertFalse($ash_trainer->pokemon_favorites->contains(function ($pokemon) use ($pikachu) {
            return $pokemon->id == $pikachu->id;
        }));
    }
}
