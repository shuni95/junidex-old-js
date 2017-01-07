<?php

/*
|---------------------
| Trainer Zone Routes
|---------------------
*/

$router->get('/register', ['as' => 'app.trainers.register.showForm', 'uses' => 'TrainerRegisterController@create']);
$router->post('/register', ['as' => 'app.trainers.register.store', 'uses' => 'TrainerRegisterController@store']);
$router->get('/thanks_for_register', ['as' => 'app.trainers.register.thanks', 'uses' => 'TrainerRegisterController@thanks']);
$router->get('/login', ['as' => 'app.trainers.login.showForm', 'uses' => 'TrainerLoginController@create']);
$router->post('/login', ['as' => 'app.trainers.login.authenticate', 'uses' => 'TrainerLoginController@login']);
$router->get('/dashboard', ['as' => 'app.trainers.dashboard', 'uses' => 'TrainerDashboardController@index']);
$router->get('/me', ['as' => 'app.trainers.profile.me', 'uses' => 'TrainerProfileController@myself']);
$router->get('/profile/{username}', ['as' => 'app.trainers.profile.show', 'uses' => 'TrainerProfileController@show']);