<?php

use Illuminate\Database\Seeder;

class PokedexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pokedexes')->insert([
            ['name' => 'Kanto'],
            ['name' => 'Johto'],
            ['name' => 'Hoenn'],
            ['name' => 'Sinnoh'],
            ['name' => 'Alola'],
        ]);
    }
}
