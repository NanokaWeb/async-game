<?php

use Vinkla\Hashids\Facades\Hashids;

$api = app('Dingo\Api\Routing\Router');

Route::bind('id', function($value, $route)
{
    return Hashids::decode($value);
});

// Authentification routes
$api->version(
    'v1',
    [
        'namespace'  => 'NanokaWeb\AsyncGame\Api\V1\Controllers',
        'middleware' => ['api.throttle', 'cors'],
        'limit' => 100,
        'expires' => 5
    ],
    function ($api) {
        // Auth email / password
        $api->post('v1/auth/signup', 'AuthController@signup');
        $api->post('v1/auth/login', 'AuthController@login');

        // Auth Facebook token
        $api->post('v1/auth/fblogin', 'AuthController@fbLogin');

        // Auth Device
        $api->post('v1/auth/devicelogin', 'AuthController@deviceLogin');

//    $api->post('v1/auth/recovery', 'NanokaWeb\AsyncGame\Api\V1\Controllers\AuthController@recovery');
//    $api->post('v1/auth/reset', 'NanokaWeb\AsyncGame\Api\V1\Controllers\AuthController@reset');
    }
);

// Need auth
$api->version('v1', ['middleware' => ['api.auth', 'api.throttle', 'cors'], 'limit' => 100, 'expires' => 5], function ($api) {

    $api->group([
        'namespace'  => 'NanokaWeb\AsyncGame\Api\V1\Controllers',
        'middleware' => ['asyncgame.roles'],
        'roles'      => ['root', 'administrator', 'user'],
    ], function ($api) {
        /*
         * Endpoint me
         */
        $api->get('v1/me', 'MeController@showMe');
        $api->get('v1/me/opponents/{nb}', 'MeController@opponentsMe')
            ->where('nb', '[0-9]')
        ;
        $api->put('v1/me', 'MeController@updateMe');

        $api->post('v1/me/coins', 'MeController@updateCoinsMe');

        /*
         * Endpoint seeds
         */
        $api->get('v1/seeds/search', 'SeedController@search');

        $api->get('v1/seeds/{id}/games', 'SeedGameController@index')
            ->where('id', '[A-Za-z0-9]+');

        $api->post('v1/seeds/{id}/games', 'SeedGameController@store')
            ->where('id', '[A-Za-z0-9]+');

    });

    $api->group([
        'namespace'  => 'NanokaWeb\AsyncGame\Api\V1\Controllers',
        'middleware' => ['roles'],
        'roles'      => ['root', 'administrator'],
    ], function ($api) {
        $api->get('v1/users/{id}', 'UserController@show')
            ->where('id', '[0-9]+')
        ;
        $api->get('v1/users/{id}/opponents/{nb}', 'UserController@opponents')
            ->where('id', '[0-9]+')
            ->where('nb', '[0-9]')
        ;
        $api->post('v1/users', 'UserController@store');
        $api->put('v1/users/{id}', 'UserController@update');

        $api->post('v1/users/{id}/coins', 'UserController@updateCoins');
    });

});