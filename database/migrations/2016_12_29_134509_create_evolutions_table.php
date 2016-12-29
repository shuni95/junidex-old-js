<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pokemon_id');
            $table->unsignedInteger('evolution_id');
            $table->unsignedInteger('method_id');
            $table->string('details');
            $table->timestamps();

            $table->foreign('pokemon_id')->references('id')->on('pokemons');
            $table->foreign('evolution_id')->references('id')->on('pokemons');
            $table->foreign('method_id')->references('id')->on('evolution_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolutions');
    }
}
