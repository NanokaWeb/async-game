<?php

namespace NanokaWeb\AsyncGame\Hash;

use Vinkla\Hashids\Facades\Hashids;
use NanokaWeb\AsyncGame\Contracts\Auth\Roleable as RoleableContract;
use NanokaWeb\AsyncGame\User;

trait Tokenable
{
    /**
     * @return string
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    /**
     * @param $query
     * @param $hashid
     * @return bool|int
     */
    public function scopeWhereHashid($query, $hashid)
    {
        $id = Hashids::decode($hashid);

        if(count($id) == 0)
            return false;

        return $query->where('id', $id[0]);
    }
}
