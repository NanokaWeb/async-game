<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

class SeedTransformer extends Transformer
{
    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $availableFields = [
        'id'
    ];

    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $defaultFields = [
        'id'
    ];
}
