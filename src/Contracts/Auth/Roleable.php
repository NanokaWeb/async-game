<?php

namespace NanokaWeb\AsyncGame\Contracts\Auth;

interface Roleable
{
    const ROLE_ROOT = 1;
    const ROLE_ADMINISTRATOR = 2;
    const ROLE_USER = 3;

    public function role();

    public function hasRole($roles);
}
