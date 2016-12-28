<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EggGroup extends Model
{
    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_x_egg_groups');
    }
}
