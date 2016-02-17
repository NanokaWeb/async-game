<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

class OpponentTransformer extends Transformer
{
    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $availableFields = [
        'first_name',
        'last_name',
        'picture',
    ];

    /**
     * Include fields without needing it to be requested.
     *
     * @var array
     */
    protected $defaultFields = [
        'first_name',
        'last_name',
        'picture',
    ];
}
