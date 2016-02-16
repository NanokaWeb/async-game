<?php

namespace NanokaWeb\AsyncGame;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'async_game_games';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'score',
        'user',
    ];

    public function user()
    {
        return $this->belongsTo('NanokaWeb\AsyncGame\User');
    }

    public function game()
    {
        return $this->belongsTo('NanokaWeb\AsyncGame\Game');
    }
}
