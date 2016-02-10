<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

class OpponentTransformer extends Transformer
{
    public function transform($user)
    {
        return [
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'picture'    => $user->picture,
        ];
    }
}
