<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $guarded = [];

    public function egg_groups()
    {
        return $this->belongsToMany(EggGroup::class, 'pokemon_x_egg_groups');
    }

    public function evolutions()
    {
        return $this->hasMany(Evolution::class);
    }

    public function owner_favorites()
    {
        return $this->belongsToMany(Trainer::class, 'trainer_x_pokemon_favorites');
    }

    public function scopeSearchByName($query)
    {
        return $query->where('name', 'LIKE', '%'.request('name').'%')
        ->orWhere('japanese_name', 'LIKE', '%'.request('name').'%')
        ->orWhere('japanese_katakana', 'LIKE', '%'.request('name').'%');
    }

    public function scopeSearchByType($query)
    {
        return $query->where('type_one', request('type'))
        ->orWhere('type_two', request('type'));
    }

    public function scopeSearchByHabitat($query)
    {
        return $query->where('habitat', request('habitat'));
    }

    public function scopeSearchByEggGroup($query)
    {
        return $query->whereHas('egg_groups', function($q) {
            $q->where('egg_groups.name', request('egg_group'));
        });
    }
}
