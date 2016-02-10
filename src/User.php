<?php

namespace NanokaWeb\AsyncGame;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NanokaWeb\AsyncGame\Auth\Roleable;
use NanokaWeb\AsyncGame\Contracts\Auth\Roleable as RoleableContract;

class User extends Authenticatable implements RoleableContract
{
    use Roleable;

    protected $table = 'async_game_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'facebook_user_id',
        'email',
        'picture',
        'password',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'first_name',
        'last_name',
        'picture',
        'facebook_user_id',
        'coins',
    ];

    /**
     * This mutator automatically hashes the password.
     *
     * @var string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }
}
