<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $guarded = [];

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
}
