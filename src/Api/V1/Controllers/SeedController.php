<?php

namespace NanokaWeb\AsyncGame\Api\V1\Controllers;

use Dingo\Api\Routing\Helpers;
use NanokaWeb\AsyncGame\Api\V1\Requests\SearchSeedRequest;
use NanokaWeb\AsyncGame\Api\V1\Transformers\SeedTransformer;
use NanokaWeb\AsyncGame\Seed;

/**
 * Class SeedController
 *
 * @package NanokaWeb\AsyncGame\Api\V1\Controllers
 */
class SeedController extends Controller
{
    /**
     * Search and Display seeds.
     *
     * @param $seedId
     *
     * @return Response
     *
     * @api               {get} /v1/seeds/search Search seeds
     * @apiVersion        1.0.0
     * @apiName           SearchSeeds
     * @apiGroup          Seeds
     * @apiPermission     User
     *
     * @apiParam {Number} [nbGamesMin=0]          Filter Seed with a minimum number of games.
     * @tmpapiParam {Number} [sort=approximatelyScore] Filter Seed with a minimum number of games.
     *
     * @apiUse SeedsSuccess
     *
     * @apiUse ApiLimitError
     */
    public function search(SearchSeedRequest $request)
    {
//        approximatelyScore
//        $nbGamesMin = $request->input('nbGamesMin', 0);
        $nbGamesMin = $request->input('nbGamesMin', 0);
//        abs
        $seeds = Seed::has('games', '>=', $nbGamesMin)->get();
        return $this->response->collection($seeds, new SeedTransformer());
    }
}
