<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonXEggGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_x_egg_groups', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pokemon_id');
            $table->unsignedInteger('egg_group_id');

            $table->foreign('pokemon_id')->references('id')->on('pokemons');
            $table->foreign('egg_group_id')->references('id')->on('egg_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pokemon_x_egg_groups', function(Blueprint $table) {
            $table->dropForeign('pokemon_x_egg_groups_pokemon_id_foreign');
            $table->dropForeign('pokemon_x_egg_groups_egg_group_id_foreign');
        });

        Schema::drop('pokemon_x_egg_groups');
    }
}
