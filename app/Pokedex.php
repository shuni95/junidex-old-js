<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{
    protected $guarded = [];

    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
