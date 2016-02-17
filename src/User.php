<?php

namespace NanokaWeb\AsyncGame;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NanokaWeb\AsyncGame\Hash\Tokenable;
use NanokaWeb\AsyncGame\Auth\Roleable;
use NanokaWeb\AsyncGame\Contracts\Auth\Roleable as RoleableContract;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class User extends Authenticatable implements RoleableContract
{
    use Roleable, SyncableGraphNodeTrait, Tokenable;

    protected $appends = ['hashid'];

    protected $table = 'async_game_users';

    /**
     * The graph node attributes aliases
     *
     * @var array
     */
    protected static $graph_node_field_aliases = [
        'id'          => 'facebook_user_id',
        'picture.url' => 'picture',
    ];

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
        'name',
        'device_id',
    ];

    /**
     * The facebook attributes that are mass assignable.
     *
     * @var array
     */
    protected static $graph_node_fillable_fields = ['first_name', 'last_name', 'email', 'picture', 'name'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'hashid',
        'first_name',
        'last_name',
        'picture',
        'facebook_user_id',
        'coins',
        'name',
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

    public function games()
    {
        return $this->hasMany('NanokaWeb\AsyncGame\Game');
    }
}
