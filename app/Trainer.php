<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Trainer extends Model implements AuthenticatableContract
{
    use Authenticatable;

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
