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
use App\EvolutionaryMethodConstants;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

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

$factory->defineAs(App\EvolutionMethod::class, 'level', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionaryMethodConstants::LEVEL_METHOD,
        'name' => 'by level',
    ];
});

$factory->defineAs(App\EvolutionMethod::class, 'trade', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionaryMethodConstants::TRADE_METHOD,
        'name' => 'by trade',
    ];
});
