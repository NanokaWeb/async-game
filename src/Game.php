<?php

namespace NanokaWeb\AsyncGame;

use Illuminate\Database\Eloquent\Model;
use NanokaWeb\AsyncGame\Hash\Tokenable;

class Game extends Model
{
    use Tokenable;

    protected $appends = ['hashid'];

    protected $table = 'async_game_games';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'score',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('NanokaWeb\AsyncGame\User');
    }

    public function seed()
    {
        return $this->belongsTo('NanokaWeb\AsyncGame\Seed');
    }
}
