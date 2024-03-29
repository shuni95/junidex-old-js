<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PokemonTypeSeeder::class);
        $this->call(PokedexSeeder::class);
        $this->call(PokemonSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PokemonFavoriteSeeder::class);
    }
}
