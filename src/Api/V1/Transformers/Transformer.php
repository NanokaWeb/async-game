<?php

namespace NanokaWeb\AsyncGame\Api\V1\Transformers;

use Illuminate\Support\Facades\Request;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $availableFields = [];

    /**
     * @return array
     */
    public function getAvailableFields()
    {
        return $this->availableFields;
    }

    /**
     * @param array $availableFields
     *
     * @return Transformer
     */
    public function setAvailableFields($availableFields)
    {
        $this->availableFields = $availableFields;
        return $this;
    }

    /**
     * Fields that can be included if requested.
     *
     * @var array
     */
    protected $defaultFields = [];

    public function transform($object)
    {
        $askedFields = explode(',', Request::input('fields'));

        $askedAndDefaultFields = array_intersect(array_merge($askedFields, $this->defaultFields), $this->availableFields);

        $forceFields = [];
        if ($object->hashid) {
            $forceFields['id'] = $object->hashid;
        }

        return array_intersect_key(array_merge($object->toArray(), $forceFields), array_flip($askedAndDefaultFields));
    }
}
