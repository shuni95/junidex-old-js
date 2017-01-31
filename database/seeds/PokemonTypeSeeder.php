<?php

use Illuminate\Database\Seeder;

class PokemonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pokemon_types')->insert([
            ['name' => 'Grass'],
            ['name' => 'Fire'],
            ['name' => 'Electric'],
            ['name' => 'Water'],
            ['name' => 'Flying'],
            ['name' => 'Ice'],
            ['name' => 'Dragon'],
            ['name' => 'Steel'],
            ['name' => 'Poison'],
            ['name' => 'Bug'],
            ['name' => 'Psychic'],
            ['name' => 'Ghost'],
            ['name' => 'Fairy'],
            ['name' => 'Dark'],
            ['name' => 'Fighting'],
            ['name' => 'Normal'],
            ['name' => 'Ground'],
            ['name' => 'Rock'],
        ]);
    }
}
