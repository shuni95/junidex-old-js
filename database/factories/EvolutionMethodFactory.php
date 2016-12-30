<?php

use App\EvolutionMethodConstants;
use App\EvolutionMethod;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->defineAs(EvolutionMethod::class, 'level', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::LEVEL_METHOD,
        'name' => 'by level',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'trade', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::TRADE_METHOD,
        'name' => 'by trade',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'megastone', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::MEGASTONE_METHOD,
        'name' => 'by megastone',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'evolutionary_stone', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::EVOLUTIONARY_STONE_METHOD,
        'name' => 'by evolutionary stone',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'location', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::LOCATION_METHOD,
        'name' => 'by certain location',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'friendship', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::FRIENDSHIP_METHOD,
        'name' => 'by friendship',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'affection', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::AFFECTION_METHOD,
        'name' => 'by affection',
    ];
});

$factory->defineAs(EvolutionMethod::class, 'movement_learned', function(Faker\Generator $faker) {
    return [
        'id' => EvolutionMethodConstants::MOVEMENT_LEARNED_METHOD,
        'name' => 'after learn a movement',
    ];
});
