<?php

$factory->defineAs(App\Trainer::class, 'ash', function() use ($factory) {
    return ['user_id' => factory(App\User::class, 'ash')->create()->id];
});

$factory->defineAs(App\Trainer::class, 'alain', function() use ($factory) {
    return ['user_id' => factory(App\User::class, 'alain')->create()->id];
});
