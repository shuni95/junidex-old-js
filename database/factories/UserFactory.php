<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'birthday' => $faker->date,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);
    return array_merge($user, ['username' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('123456')]);
});

$factory->defineAs(App\User::class, 'ash', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);
    return array_merge($user, ['name' => 'Ash', 'lastname' => 'Ketchum', 'birthday' => '1995-04-14', 'username' => 'KalosChampion', 'email' => 'ash_champion@test.com', 'password' => bcrypt('123456')]);
});

$factory->defineAs(App\User::class, 'alain', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);
    return array_merge($user, ['name' => 'Alain', 'lastname' => 'Emo', 'birthday' => '1995-06-06', 'username' => 'Alain123', 'email' => 'alain@test.com', 'password' => bcrypt('123456')]);
});

$factory->defineAs(App\Admin::class, 'admin', function() use ($factory) {
    return ['user_id' => factory(App\User::class, 'admin')->create()->id];
});
