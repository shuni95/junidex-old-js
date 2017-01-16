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

    protected $number_of_favorites;

    public function setUp()
    {
        parent::setUp();
        $this->number_of_favorites = 3;
    }

    /** @test */
    public function trainer_can_favorite_a_pokemon()
    {
        $ash = factory(User::class, 'ash')->make();
        $user = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($user->id);

        $pikachu = factory(Pokemon::class)->create(['name' => 'Pikachu']);

        $this->actingAs($ash_trainer, 'trainer');

        $this->assertTrue($ash_trainer->pokemon_favorites->count() == $this->number_of_favorites);

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(201);

        $ash_trainer = Trainer::find($user->id);

        $this->assertTrue($ash_trainer->pokemon_favorites->contains($pikachu));
    }

    /** @test */
    public function trainer_cannot_favorite_a_non_existent_pokemon()
    {
        $ash = factory(User::class, 'ash')->make();
        $user = User::where('username', $ash->username)->first();
        $ash_trainer = Trainer::find($user->id);

        $pikachu = factory(Pokemon::class)->make(['name' => 'Pikachu']);

        $this->actingAs($ash_trainer, 'trainer');

        $this->assertTrue($ash_trainer->pokemon_favorites->count() == $this->number_of_favorites);

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $this->assertResponseStatus(422);

        $ash_trainer = Trainer::find($user->id);

        $this->assertFalse($ash_trainer->pokemon_favorites->contains($pikachu));
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

        $this->assertTrue($ash_trainer->pokemon_favorites->count() == $this->number_of_favorites + 1);

        $this->call('POST', '/pokemon/add_to_favorites', ['pokemon_id' => $pikachu->id]);

        $ash_trainer = Trainer::find($user->id);

        $this->assertResponseStatus(409);

        $this->assertTrue($ash_trainer->pokemon_favorites->count() == $this->number_of_favorites + 1);
    }
}
