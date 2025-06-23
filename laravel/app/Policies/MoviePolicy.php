<?php

namespace App\Policies;

use App\Models\User;
use App\Facades\Permissions;

class MoviePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function hasAddToListPermission() {
        return Permissions::isAuthorized('user');
    }
}
