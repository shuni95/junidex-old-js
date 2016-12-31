<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/searchPokemon', ['as' => 'app.search_pokemon', 'uses' => 'PokemonSearchController@index']);
Route::get('/evolution_chain/{name}', ['as' => 'app.evolution_chain', 'uses' => 'EvolutionChainPokemonController@show']);

Route::get('/trainers/register', ['as' => 'app.trainers.register.showForm', 'uses' => 'TrainerRegisterController@create']);
Route::post('/trainers/register', ['as' => 'app.trainers.register.store', 'uses' => 'TrainerRegisterController@store']);
Route::get('/trainers/thanks_for_register', ['as' => 'app.trainers.register.thanks', 'uses' => 'TrainerRegisterController@thanks']);
