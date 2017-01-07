<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Trainer;
use App\Pokemon;

class FavoritePokemonTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /** @test */
    public function trainer_can_favorite_a_pokemon()
    {
        $ash = factory(User::class, 'ash')->make();
        $user = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($user->id);

        $pikachu = factory(Pokemon::class)->create(['name' => 'Pikachu']);

        $this->actingAs($ash_trainer, 'trainer');

        $this->assertTrue($ash_trainer->pokemon_favorites->isEmpty());

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(201);

        $ash_trainer = Trainer::find($user->id);

        $this->assertTrue($ash_trainer->pokemon_favorites->contains(function ($pokemon) use ($pikachu) {
            return $pokemon->id == $pikachu->id;
        }));
    }

    /** @test */
    public function trainer_cannot_favorite_a_non_existent_pokemon()
    {
        $ash = factory(User::class, 'ash')->make();
        $user = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($user->id);

        $pikachu = factory(Pokemon::class)->make(['name' => 'Pikachu']);

        $this->actingAs($ash_trainer, 'trainer');

        $this->assertTrue($ash_trainer->pokemon_favorites->isEmpty());

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(422);

        $ash_trainer = Trainer::find($user->id);

        $this->assertFalse($ash_trainer->pokemon_favorites->contains(function ($pokemon) use ($pikachu) {
            return $pokemon->id == $pikachu->id;
        }));
    }

    /** @test */
    public function trainer_cannot_favorite_a_pokemon_twice()
    {
        $ash = factory(User::class, 'ash')->make();
        $user = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($user->id);

        $pikachu = factory(Pokemon::class)->create(['name' => 'Pikachu']);

        $this->actingAs($ash_trainer, 'trainer');

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(201);

        $ash_trainer = Trainer::find($user->id);

        $this->assertTrue($ash_trainer->pokemon_favorites->count() == 1);

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(204);

        $this->assertTrue($ash_trainer->pokemon_favorites->count() == 1);
    }
}
