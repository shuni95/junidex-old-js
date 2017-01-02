<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    public $primaryKey = 'user_id';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pokemon_favorites()
    {
        return $this->belongsToMany(Pokemon::class, 'trainer_x_pokemon_favorites');
    }
}
