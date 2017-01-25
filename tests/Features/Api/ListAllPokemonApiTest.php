<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Pokemon;

class ListAllPokemonApiTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function testExample()
    {
        factory(Pokemon::class, 'bulbasaur')->create();
        factory(Pokemon::class, 'charmander')->create();
        factory(Pokemon::class, 'squirtle')->create();

        $this->json('GET', '/api/pokemon/all')
             ->seeJson([
                 [
                    'name' => 'Bulbasaur',
                    'types' => ['Grass', 'Poison'],
                    'japanese_name' => 'Fushigidane'
                 ],
                 [
                    'name' => 'Charmander',
                    'types' => ['Fire'],
                    'japanese_name' => 'Hitokage'
                 ],
                 [
                    'name' => 'Squirtle',
                    'types' => ['Water'],
                    'japanese_name' => 'Zenigame'
                 ]
             ]);
    }
}
