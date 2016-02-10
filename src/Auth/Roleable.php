<?php

namespace NanokaWeb\AsyncGame\Auth;

use NanokaWeb\AsyncGame\Contracts\Auth\Roleable as RoleableContract;
use NanokaWeb\AsyncGame\User;

trait Roleable
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootRoleable()
    {
        User::creating(function ($user) {
            $user->attributes = array_merge([
                'role_id' => self::ROLE_USER,
            ], $user->attributes);
        });
    }

    public function role()
    {
        return $this->belongsTo('NanokaWeb\AsyncGame\Role');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        // Check if the user is a root account
        if ($this->have_role->name == 'Root') {
            return true;
        }
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }

        return false;
    }

    protected function getUserRole()
    {
        return $this->role()->getResults();
    }

    protected function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }
}
