<?php

use Illuminate\Database\Seeder;

use App\Pokemon;
use App\Trainer;

class PokemonFavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainer_x_pokemon_favorites')->delete();

        Trainer::find(1)->pokemon_favorites()->attach([1,2,3]);
    }
}
