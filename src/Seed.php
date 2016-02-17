<?php

namespace NanokaWeb\AsyncGame;

use Illuminate\Database\Eloquent\Model;
use NanokaWeb\AsyncGame\Hash\Tokenable;

class Seed extends Model
{
    use Tokenable;

    protected $appends = ['hashid'];

    protected $table = 'async_game_seeds';

    public function games()
    {
        return $this->hasMany('NanokaWeb\AsyncGame\Game');
    }
}
