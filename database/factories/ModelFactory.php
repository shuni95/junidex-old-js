<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Pokemon::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Bulbasaur',
        'japanese_name' => 'Fushigidane',
        'japanese_katakana' => 'フシギダネ',
        'type_one' => 'Grass',
        'habitat' => 'Meadow'
    ];
});

$factory->define(App\EggGroup::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Ditto',
    ];
});
