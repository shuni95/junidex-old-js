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
}
