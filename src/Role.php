<?php

namespace NanokaWeb\AsyncGame;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'async_game_roles';

    public function users()
    {
        return $this->hasMany('NanokaWeb\AsyncGame\User');
    }
}
