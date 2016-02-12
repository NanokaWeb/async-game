<?php

namespace NanokaWeb\AsyncGame;

use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    protected $table = 'async_game_seeds';

    public function games()
    {
        return $this->hasMany('NanokaWeb\AsyncGame\Game');
    }
}
