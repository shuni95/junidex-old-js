<?php

use Illuminate\Database\Seeder;

class PokedexSeederTest extends Seeder
{
    public function run()
    {
        DB::table('pokedexes')->insert([
            ['name' => 'Kanto'],
            ['name' => 'Hoenn'],
            ['name' => 'Johto'],
            ['name' => 'Alola']
        ]);
    }
}
