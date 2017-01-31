<?php

use Illuminate\Database\Seeder;

use App\PokemonType;

class PokemonSeederTest extends Seeder
{
    public function run()
    {
        DB::table('pokemons')->insert([
            ['name' => 'Bulbasaur', 'japanese_name' => 'Fushigidane', 'japanese_katakana' => 'フシギダネ', 'type_one' => PokemonType::GRASS_TYPE, 'type_two' => PokemonType::POISON_TYPE, 'habitat' => 'Meadow', 'origin' => 'Kanto'],
            ['name' => 'Ivysaur', 'japanese_name' => 'Fushigisou', 'japanese_katakana' => 'フシギソウ', 'type_one' => PokemonType::GRASS_TYPE, 'type_two' => PokemonType::POISON_TYPE, 'habitat' => 'Meadow', 'origin' => 'Kanto'],
            ['name' => 'Venusaur', 'japanese_name' => 'Fushigibana', 'japanese_katakana' => 'フシギバナ', 'type_one' => PokemonType::GRASS_TYPE, 'type_two' => PokemonType::POISON_TYPE, 'habitat' => 'Meadow', 'origin' => 'Kanto'],
            ['name' => 'Charmander', 'japanese_name' => 'Hitokage', 'japanese_katakana' => 'ヒトカゲ', 'type_one' => PokemonType::FIRE_TYPE, 'type_two' => null, 'habitat' => 'Mountain', 'origin' => 'Kanto'],
            ['name' => 'Charmeleon', 'japanese_name' => 'Lizardo', 'japanese_katakana' => 'リザード', 'type_one' => PokemonType::FIRE_TYPE, 'type_two' => null, 'habitat' => 'Mountain', 'origin' => 'Kanto'],
            ['name' => 'Charizard', 'japanese_name' => 'Lizardon', 'japanese_katakana' => 'リザードン', 'type_one' => PokemonType::FIRE_TYPE, 'type_two' => PokemonType::FLYING_TYPE, 'habitat' => 'Mountain', 'origin' => 'Kanto'],
            ['name' => 'Squirtle', 'japanese_name' => 'Zenigame', 'japanese_katakana' => 'ゼニガメ', 'type_one' => PokemonType::WATER_TYPE, 'type_two' => null, 'habitat' => 'Fresh Water', 'origin' => 'Kanto'],
            ['name' => 'Wartortle', 'japanese_name' => 'Kameil', 'japanese_katakana' => 'カメール', 'type_one' => PokemonType::WATER_TYPE, 'type_two' => null, 'habitat' => 'Fresh Water', 'origin' => 'Kanto'],
            ['name' => 'Blastoise', 'japanese_name' => 'Kamex', 'japanese_katakana' => 'カメックス', 'type_one' => PokemonType::WATER_TYPE, 'type_two' => null , 'habitat' => 'Fresh Water', 'origin' => 'Kanto'],
            ['name' => 'Pikachu', 'japanese_name' => 'Pikachu', 'japanese_katakana' => 'ピカチュウ', 'type_one' => PokemonType::ELECTRIC_TYPE, 'habitat' => 'Forest', 'origin' => 'Kanto']
        ]);
    }
}
