<?php

use Illuminate\Database\Seeder;

use App\Pokemon;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pokemon::class)->create(['id' => 1, 'name' => 'Charmander', 'japanese_name' => 'Hitokage', 'japanese_katakana' => 'ヒトカゲ', 'type_one' => 'Fire', 'habitat' => 'Mountain']);
        factory(Pokemon::class)->create(['id' => 2, 'name' => 'Charizard', 'japanese_name' => 'Lizardon', 'japanese_katakana' => 'リザードン', 'type_one' => 'Fire','type_two' => 'Flying', 'habitat' => 'Mountain']);
        factory(Pokemon::class)->create(['id' => 3, 'name' => 'Psyduck', 'japanese_name' => 'Koduck', 'japanese_katakana' => 'コダック', 'type_one' => 'Water', 'habitat' => 'Fresh Water']);
        factory(Pokemon::class)->create(['name' => 'Squirtle', 'type_one' => 'Water', 'habitat' => 'Fresh Water']);
        factory(Pokemon::class)->create(['name' => 'Arceus', 'type_one' => 'Normal', 'habitat' => 'Not determined']);
        factory(Pokemon::class)->create(['name' => 'Pikachu', 'habitat' => 'Forest']);
        factory(Pokemon::class)->create(['name' => 'Metapod', 'habitat' => 'Forest']);
        factory(Pokemon::class)->create(['name' => 'Dratini', 'habitat' => 'Fresh Water']);
        factory(Pokemon::class)->create(['name' => 'Arcanine', 'type_one' => 'Fire', 'habitat' => 'Meadow']);
        factory(Pokemon::class)->create(['name' => 'Lapras',     'type_one' => 'Water', 'habitat' => 'Salt Water', 'type_two' => 'Ice']);
    }
}
