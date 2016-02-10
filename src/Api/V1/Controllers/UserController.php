<?php

namespace NanokaWeb\AsyncGame\Api\V1\Controllers;

use Illuminate\Http\Request;
use NanokaWeb\AsyncGame\Api\V1\Requests\StoreUserRequest;
use NanokaWeb\AsyncGame\Api\V1\Requests\UpdateUserCoinsRequest;
use NanokaWeb\AsyncGame\Api\V1\Transformers\OpponentTransformer;
use NanokaWeb\AsyncGame\Api\V1\Transformers\UserTransformer;
use NanokaWeb\AsyncGame\User;

/**
 * Class UserController
 *
 * @package NanokaWeb\AsyncGame\Api\V1\Controllers
 */
class UserController extends Controller
{
    protected $user;
    protected $request;

    /**
     * Controller constructor.
     *
     * @param User $user User eloquent model
     */
    public function __construct(User $user, Request $request)
    {
        $this->user    = $user;
        $this->request = $request;
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     *
     * @return Response
     *
     * @apiIgnore         No need for the moment
     * @api               {get} /v1/users/:id Request User information
     * @apiVersion        1.0.0
     * @apiName           GetUser
     * @apiGroup          User Admin Basic
     * @apiPermission     Administrator
     *
     * @apiParam {Number} id Users unique ID.
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users/2
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
     * @apiUse UserNotFoundError
     * @apiUse ApiLimitError
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return $this->response->errorNotFound('User not found.');
        }

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * Store a new user.
     *
     * @param  StoreUserRequest   $request
     *
     * @return Response
     *
     * @apiIgnore         No need for the moment
     * @api               {post} /v1/users Store a new user
     * @apiVersion        1.0.0
     * @apiName           StoreUser
     * @apiGroup          User Admin Basic
     * @apiPermission     Administrator
     *
     * @apiParam {String} first_name       Firstname of the User.
     * @apiParam {String} last_name        Lastname of the User.
     * @apiParam {Number} facebook_user_id Facebook id of the User.
     * @apiParam {String} picture          Profile picture url of the User.
     * @apiParam {String} email            Email of the User.
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users -d "first_name=John&last_name=Doe&facebook_user_id=75452212&picture=http://lorempixel.com/200/200/?85224"
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
    public function store(StoreUserRequest $request)
    {
        $user = $this->user->create($request->all());
        $user->save();

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * Update User information.
     *
     * @param  StoreUserRequest   $request
     *
     * @return Response
     *
     * @apiIgnore         No need for the moment
     * @api               {put} /v1/users/:id Update User information
     * @apiVersion        1.0.0
     * @apiName           UpdateUser
     * @apiGroup          User Admin Basic
     * @apiPermission     Administrator
     *
     * @apiParam {Number} id               Id of the User.
     * @apiParam {String} first_name       Firstname of the User.
     * @apiParam {String} last_name        Lastname of the User.
     * @apiParam {Number} facebook_user_id Facebook id of the User.
     * @apiParam {String} picture          Profile picture url of the User.
     * @apiParam {String} email            Email of the User.
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users/1 -X PUT -d "first_name=John&last_name=Doe&facebook_user_id=75452212&picture=http://lorempixel.com/200/200/?85224"
     * @apiExample {curl} Example usage with POST HTTP method (useful for client which support only GET and POST):
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users/1 -X POST -H "X-HTTP-Method-Override: PUT" -d "first_name=John&last_name=Doe&facebook_user_id=75452212&picture=http://lorempixel.com/200/200/?85224"
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
     * @apiUse UserNotFoundError
     * @apiUse ApiLimitError
     */
    public function update($id, StoreUserRequest $request)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return $this->response->errorNotFound('User not found.');
        }

        $user->update($request->all());

        return $this->response->item($user, new UserTransformer());
    }


    /**
     * Update User coins number information.
     *
     * @param  UpdateUserCoinsRequest   $request
     *
     * @return Response
     *
     * @apiIgnore         No need for the moment
     * @api               {post} /v1/users/:id/coins Update User coins number information
     * @apiVersion        1.0.0
     * @apiName           UpdateUserCoins
     * @apiGroup          User Admin Extra
     * @apiPermission     Administrator
     *
     * @apiParam {Number} id               Id of the User.
     * @apiParam {Number} nb               Number of coins to add or remove.
     *
     * @apiExample {curl} Example add usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users/1/coins -X POST -d "nb=3"
     * @apiExample {curl} Example remove usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users/1/coins -X POST -d "nb=-2"
     *
     * @apiSuccess {Object}   data       User coins information.
     * @apiSuccess {Number}   data.coins Coins of the User.
     *
     * @apiUse UserNotFoundError
     * @apiUse ApiLimitError
     */
    public function updateCoins($id, UpdateUserCoinsRequest $request)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return $this->response->errorNotFound('User not found.');
        }

        $user->coins = $user->coins + $request->input('nb');
        $user->save();

        return $this->response->array(['data' => ['coins' => $user->coins]]);
    }

    /**
     * Display random opponents users.
     *
     * @param  int $id
     * @param  int $nb
     *
     * @return Response
     *
     * @apiIgnore         No need for the moment
     * @api               {get} /v1/users/:id/opponents/:nb Request random opponents information
     * @apiVersion        1.0.0
     * @apiName           GetUserOpponents
     * @apiGroup          User Admin Extra
     * @apiPermission     Administrator
     *
     * @apiParam {Number} id Users unique ID.
     * @apiParam {Number} nb Number of opponents to get.
     *
     * @apiExample {curl} Example usage:
     *     curl -i https://asyncgame.nanoka.fr/api/v1/users/2/opponents/4
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
     * @apiUse UserNotFoundError
     * @apiUse ApiLimitError
     */
    public function opponents($id, $nb)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return $this->response->errorNotFound('User not found.');
        }

        $users = $this->user->where('id', '<>', $id)->orderByRaw('RAND()')->take($nb)->get();
        return $this->response->collection($users, new OpponentTransformer());
    }
}
