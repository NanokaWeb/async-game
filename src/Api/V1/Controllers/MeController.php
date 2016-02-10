<?php

namespace NanokaWeb\AsyncGame\Api\V1\Controllers;

use NanokaWeb\AsyncGame\Api\V1\Requests\StoreUserRequest;
use NanokaWeb\AsyncGame\Api\V1\Requests\UpdateUserCoinsRequest;
use NanokaWeb\AsyncGame\Api\V1\Transformers\OpponentTransformer;
use NanokaWeb\AsyncGame\Api\V1\Transformers\UserTransformer;
use NanokaWeb\AsyncGame\User;

/**
 * Class MeController
 *
 * @package NanokaWeb\AsyncGame\Api\V1\Controllers
 */
class MeController extends UserController
{
    /**
     * Display the user.
     *
     * @return Response
     *
     * @api               {get} /v1/me Request User information
     * @apiVersion        1.0.0
     * @apiName           GetMe
     * @apiGroup          User Basic
     * @apiPermission     User
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/me
     *
     * @apiSuccess {Object} data                  User profile information.
     * @apiSuccess {Number} data.id               Id of the User.
     * @apiSuccess {String} data.first_name       Firstname of the User.
     * @apiSuccess {String} data.last_name        Lastname of the User.
     * @apiSuccess {Number} data.facebook_user_id Facebook id of the User.
     * @apiSuccess {String} data.picture          Profile picture url of the User.
     * @apiSuccess {Number} data.coins            Coins of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data": {
     *             "id": 1,
     *             "first_name": "John",
     *             "last_name": "Doe",
     *             "facebook_user_id": 122525564,
     *             "picture": "http:\/\/lorempixel.com\/200\/200\/?44520"
     *             "coins": "14"
     *         }
     *     }
     *
     * @apiUse ApiLimitError
     */
    public function show($id = null)
    {
        $id = $this->request->user()->id;
        return parent::show($id);
    }

    /**
     * Update User information.
     *
     * @param  StoreUserRequest   $request
     *
     * @return Response
     *
     * @api               {put} /v1/me Update User information
     * @apiVersion        1.0.0
     * @apiName           UpdateMe
     * @apiGroup          User Basic
     * @apiPermission     User
     *
     * @apiParam {String} first_name       Firstname of the User.
     * @apiParam {String} last_name        Lastname of the User.
     * @apiParam {Number} facebook_user_id Facebook id of the User.
     * @apiParam {String} picture          Profile picture url of the User.
     * @apiParam {String} email            Email of the User.
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/me -X PUT -d "first_name=John&last_name=Doe&facebook_user_id=75452212&picture=http://lorempixel.com/200/200/?85224"
     * @apiExample {curl} Example usage with POST HTTP method (useful for client which support only GET and POST):
     *     curl -i https://asyncgame.nanoka.fr/api/v1/me -X POST -H "X-HTTP-Method-Override: PUT" -d "first_name=John&last_name=Doe&facebook_user_id=75452212&picture=http://lorempixel.com/200/200/?85224"
     *
     * @apiSuccess {Object}   data                  User profile information.
     * @apiSuccess {Number}   data.id               Id of the User.
     * @apiSuccess {String}   data.first_name       Firstname of the User.
     * @apiSuccess {String}   data.last_name        Lastname of the User.
     * @apiSuccess {Number}   data.facebook_user_id Facebook id of the User.
     * @apiSuccess {String}   data.picture          Profile picture url of the User.
     * @apiSuccess {Number}   data.coins            Coins of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "data": {
     *             "id": 1,
     *             "first_name": "John",
     *             "last_name": "Doe",
     *             "facebook_user_id": 75452212,
     *             "picture": "http:\/\/lorempixel.com\/200\/200\/?85224"
     *         }
     *     }
     *
     * @apiUse ApiLimitError
     */
    public function update($id = null, StoreUserRequest $request)
    {
        $id = $this->request->user()->id;
        return parent::update($id, $request);
    }

    /**
     * Update User coins number information.
     *
     * @param  UpdateUserCoinsRequest   $request
     *
     * @return Response
     *
     * @api               {post} /v1/me/coins Update User coins number information
     * @apiVersion        1.0.0
     * @apiName           UpdateMyCoins
     * @apiGroup          User Extra
     * @apiPermission     User
     *
     * @apiParam {Number} nb               Number of coins to add or remove.
     *
     * @apiExample {curl} Example add usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/me/coins -X POST -d "nb=3"
     * @apiExample {curl} Example remove usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/me/coins -X POST -d "nb=-2"
     *
     * @apiSuccess {Object}   data       User coins information.
     * @apiSuccess {Number}   data.coins Coins of the User.
     *
     * @apiUse ApiLimitError
     */
    public function updateCoins($id = null, UpdateUserCoinsRequest $request)
    {
        $id = $this->request->user()->id;
        return parent::updateCoins($id, $request);
    }

    /**
     * Display random opponents users for the user.
     *
     * @param  int $id
     * @param  int $nb
     *
     * @return Response
     *
     * @api               {get} /v1/me/opponents/:nb Request random opponents information for the user
     * @apiVersion        1.0.0
     * @apiName           GetMyOpponents
     * @apiGroup          User Extra
     * @apiPermission     User
     *
     * @apiParam {Number} nb Number of opponents to get.
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/me/opponents/4
     *
     * @apiSuccess {Object[]} data            User profile information.
     * @apiSuccess {String}   data.first_name Firstname of the User.
     * @apiSuccess {String}   data.last_name  Lastname of the User.
     * @apiSuccess {String}   data.picture    Profile picture url of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "data":[
     *           {
     *              "first_name":"Bryon",
     *              "last_name":"Fahey",
     *              "picture":"http:\/\/lorempixel.com\/200\/200\/?69336"
     *           },
     *           {
     *              "first_name":"Halie",
     *              "last_name":"Ledner",
     *              "picture":"http:\/\/lorempixel.com\/200\/200\/?60465"
     *           },
     *           {
     *              "first_name":"Vincenzo",
     *              "last_name":"Steuber",
     *              "picture":"http:\/\/lorempixel.com\/200\/200\/?34349"
     *           },
     *           {
     *              "first_name":"Erwin",
     *              "last_name":"Bahringer",
     *              "picture":"http:\/\/lorempixel.com\/200\/200\/?83316"
     *           }
     *        ]
     *     }
     *
     * @apiUse ApiLimitError
     */
    public function opponents($id = null, $nb)
    {
        $id = $this->request->user()->id;
        return parent::opponents($id, $nb);
    }
}
