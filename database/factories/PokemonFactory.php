<?php

$factory->defineAs(App\Pokemon::class, 'bulbasaur', function () {
    return ['name' => 'Bulbasaur', 'japanese_name' => 'Fushigidane', 'japanese_katakana' => 'フシギダネ', 'type_one' => 'Grass', 'type_two' => 'Poison', 'habitat' => 'Meadow'];
});

$factory->defineAs(App\Pokemon::class, 'squirtle', function () {
    return ['name' => 'Squirtle', 'japanese_name' => 'Zenigame', 'japanese_katakana' => 'ゼニガメ', 'type_one' => 'Water', 'habitat' => 'Fresh Water'];
});

$factory->defineAs(App\Pokemon::class, 'charmander', function () {
    return ['name' => 'Charmander', 'japanese_name' => 'Hitokage', 'japanese_katakana' => 'ヒトカゲ', 'type_one' => 'Fire', 'habitat' => 'Mountain'];
});

$factory->defineAs(App\Pokemon::class, 'pikachu', function () {
    return ['name' => 'Pikachu', 'japanese_name' => 'Pikachu', 'japanese_katakana' => 'ピカチュウ', 'type_one' => 'Electric', 'habitat' => 'Forest'];
});
