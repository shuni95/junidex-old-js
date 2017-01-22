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

$router->get('/', function () {
    return view('index');
});

$router->get('/searchPokemon', ['as' => 'app.search_pokemon', 'uses' => 'PokemonSearchController@index']);
$router->get('/evolution_chain/{name}', ['as' => 'app.evolution_chain', 'uses' => 'EvolutionChainPokemonController@show']);

$router->get('/api/pokemon/all', ['as' => 'api.pokemon.all', 'uses' => 'Api\PokemonController@index']);
