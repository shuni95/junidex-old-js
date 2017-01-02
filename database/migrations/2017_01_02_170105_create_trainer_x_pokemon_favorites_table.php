<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerXPokemonFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_x_pokemon_favorites', function (Blueprint $table) {
            $table->unsignedInteger('trainer_id');
            $table->unsignedInteger('pokemon_id');
            $table->timestamps();

            $table->foreign('trainer_id')->references('user_id')->on('trainers');
            $table->foreign('pokemon_id')->references('id')->on('pokemons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainer_x_pokemon_favorites', function(Blueprint $table) {
            $table->dropForeign('trainer_x_pokemon_favorites_trainer_id_foreign');
            $table->dropForeign('trainer_x_pokemon_favorites_pokemon_id_foreign');
        });

        Schema::dropIfExists('trainer_x_pokemon_favorites');
    }
}
