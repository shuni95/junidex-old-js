<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $guarded = [];

    protected $appends = ['types'];

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

    public function pokedexes()
    {
        return $this->belongsToMany(Pokedex::class);
    }

    public function type_primary()
    {
        return $this->belongsTo(PokemonType::class, 'type_one');
    }

    public function type_secondary()
    {
        return $this->belongsTo(PokemonType::class, 'type_two');
    }

    public function scopeSearchByName($query)
    {
        return $query->where('name', 'LIKE', '%'.request('name').'%')
        ->orWhere('japanese_name', 'LIKE', '%'.request('name').'%')
        ->orWhere('japanese_katakana', 'LIKE', '%'.request('name').'%');
    }

    public function scopeSearchByType($query)
    {
        return $query->whereHas('type_primary', function($type) {
            $type->where('name', request('type'));
        })->orWhereHas('type_secondary', function($type) {
            $type->where('name', request('type'));
        });
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

    public function scopeOrderByFavs($query, $direction = 'asc')
    {
        return $this->withNumFavs()->orderBy('num_favs', $direction);
    }

    public function scopeWithNumFavs($query)
    {
        return $query->select(\DB::raw('pokemons.*, count(trainer_x_pokemon_favorites.pokemon_id) as num_favs'))
            ->leftJoin('trainer_x_pokemon_favorites',
                   'pokemons.id', '=', 'trainer_x_pokemon_favorites.pokemon_id')
            ->groupBy('pokemons.id');
    }

    public function getNumFavsFormattedAttribute()
    {
        $quantity = $this->num_favs;

        if ($quantity == 0) {
            return 'No Favs';
        } elseif ($quantity == 1) {
            return '1 Fav';
        } else {
            return $quantity. ' Favs';
        }
    }

    public function getTypeAttribute()
    {
        if ($this->type_two) {
            return $this->type_one . '/' . $this->type_two;
        }

        return $this->type_one;
    }

    public function getTypesAttribute()
    {
        if ($this->type_two) {
            return [$this->type_one, $this->type_two];
        }

        return [$this->type_one];
    }
}
