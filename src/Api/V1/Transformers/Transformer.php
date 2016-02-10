<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    public function transform($object)
    {
        return $object->toArray();
    }
}
