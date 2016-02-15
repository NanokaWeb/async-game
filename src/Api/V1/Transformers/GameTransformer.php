<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

class GameTransformer extends Transformer
{
    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $availableFields = [
        'id',
        'data',
        'score',
    ];

    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $defaultFields = [
        'id',
        'data',
        'score',
    ];
}
