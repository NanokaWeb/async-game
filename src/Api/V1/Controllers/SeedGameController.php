<?php

namespace NanokaWeb\AsyncGame\Api\V1\Controllers;

use NanokaWeb\AsyncGame\Api\V1\Requests\StoreSeedGameRequest;
use NanokaWeb\AsyncGame\Api\V1\Transformers\GameTransformer;
use NanokaWeb\AsyncGame\Game;
use NanokaWeb\AsyncGame\Seed;
use NanokaWeb\AsyncGame\User;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class SeedGameController
 *
 * @package NanokaWeb\AsyncGame\Api\V1\Controllers
 */
class SeedGameController extends Controller
{
    protected $seed;
    protected $game;
    protected $user;

    /**
     * Controller constructor.
     *
     * @param Seed $seed Seed eloquent model
     * @param Game $game Game eloquent model
     * @param User $user Game eloquent model
     */
    public function __construct(Seed $seed, Game $game, User $user)
    {
        $this->seed = $seed;
        $this->game = $game;
        $this->user = $user;
    }

    /**
     * Display the games of a seed.
     *
     * @param $seedId
     *
     * @return Response
     *
     * @api               {get} /v1/seeds/:id/games Request the games information of a seed
     * @apiVersion        1.0.0
     * @apiName           GetSeedGames
     * @apiGroup          Seeds
     * @apiPermission     User
     *
     * @apiParam {String} id Seed unique ID.
     *
     * @apiUse GamesSuccess
     *
     * @apiUse ApiLimitError
     */
    public function index($seedId)
    {
        $games = $this->seed->find($seedId)->first()->games;
        return $this->response->collection($games, new GameTransformer());
    }

    /**
     * Store a new game for the current seed.
     *
     * @param  StoreSeedGameRequest   $request
     *
     * @return Response
     *
     * @api               {post} /v1/seeds/:id/games Store a new game of a seed.
     * @apiVersion        1.0.0
     * @apiName           StoreSeedGame
     * @apiGroup          Seeds
     * @apiPermission     User
     *
     * @apiParam {String} user_id          User unique ID.
     * @apiParam {String} data             Game's data in json format.
     * @apiParam {Number} score            Game's score.
     *
     * @apiUse GamesSuccess
     *
     * @apiUse ApiLimitError
     */
    public function store($seedId, StoreSeedGameRequest $request)
    {
        $user = $this->user->find(Hashids::decode($request->input('user_id')))->first();
        $game = new Game($request->only('data', 'score'));
        $game->user()->associate($user);
        $game = $this->seed->find($seedId)->first()->games()->save($game);
        return $this->response->item($game, new GameTransformer());
    }
}
