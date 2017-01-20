<?php

$router->get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminDashboardController@index']);
$router->get('/login', ['as' => 'admin.login.showForm', 'uses' => 'AdminLoginController@create'])->middleware('guest:admin');
$router->post('/login', ['as' => 'admin.login.authenticate', 'uses' => 'AdminLoginController@login']);

$router->get('/pokemon/index', ['as' => 'admin.pokemon.index', 'uses' => 'PokemonController@index']);
$router->get('/pokemon/add', ['as' => 'admin.pokemon.add_form', 'uses' => 'PokemonController@create']);
