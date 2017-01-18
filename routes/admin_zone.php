<?php

$router->get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminDashboardController@index']);
$router->get('/login', ['as' => 'admin.login.showForm', 'uses' => 'AdminLoginController@create'])->middleware('guest:admin');
$router->post('/login', ['as' => 'admin.login.authenticate', 'uses' => 'AdminLoginController@login']);
