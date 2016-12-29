<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evolution extends Model
{
    protected $guarded = [];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_id');
    }

    public function pokemon_evolution()
    {
        return $this->belongsTo(Pokemon::class, 'evolution_id');
    }

    public function method()
    {
        return $this->belongsTo(EvolutionMethod::class, 'method_id');
    }
}
