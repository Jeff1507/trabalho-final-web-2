<?php

namespace App\Policies;

use App\Models\User;
use App\Facades\Permissions;

class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function hasFullPermission() {
        return Permissions::isAuthorized('user');
    }
}
