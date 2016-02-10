<?php

namespace NanokaWeb\AsyncGame\Api\V1\Controllers;


use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    use Helpers;

    public function search(Request $request)
    {
        $q          = $request->input('q');
        $nbGamesMin = $request->input('nbGamesMin');
        $q          = $request->input('q');
        $q          = $request->input('q');
    }
}
