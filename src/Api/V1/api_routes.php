<?php

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 100, 'expires' => 5], function ($api) {
    $api->post('v1/auth/login', 'NanokaWeb\AsyncGame\Api\V1\Controllers\AuthController@login');
    $api->post('v1/auth/signup', 'NanokaWeb\AsyncGame\Api\V1\Controllers\AuthController@signup');
    $api->post('v1/auth/recovery', 'NanokaWeb\AsyncGame\Api\V1\Controllers\AuthController@recovery');
    $api->post('v1/auth/reset', 'NanokaWeb\AsyncGame\Api\V1\Controllers\AuthController@reset');
});

// Need auth
$api->version('v1', ['middleware' => ['api.auth', 'api.throttle'], 'limit' => 100, 'expires' => 5], function ($api) {

    $api->group([
        'namespace'  => 'NanokaWeb\AsyncGame\Api\V1\Controllers',
        'middleware' => ['asyncgame.roles'],
        'roles'      => ['root', 'administrator', 'user'],
    ], function ($api) {
        // Tests
        $api->get('v1/me', 'MeController@show')
            ->where('id', '[0-9]+')
        ;
        $api->get('v1/me/opponents/{nb}', 'MeController@opponents')
            ->where('id', '[0-9]+')
            ->where('nb', '[0-9]')
        ;
        $api->put('v1/me', 'MeController@update');

        $api->post('v1/me/coins', 'MeController@updateCoins');
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