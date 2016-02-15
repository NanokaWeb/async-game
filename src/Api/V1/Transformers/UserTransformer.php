<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

use NanokaWeb\AsyncGame\User;

class UserTransformer extends Transformer
{
    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $availableFields = [
        'id',
        'first_name',
        'last_name',
        'facebook_user_id',
        'picture',
        'coins',
        'name',
    ];

    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $defaultFields = [
        'id',
        'first_name',
        'last_name',
        'facebook_user_id',
        'picture',
        'coins',
        'name',
    ];
}
