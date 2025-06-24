<?php

namespace App\Policies;

use App\Models\User;
use App\Facades\Permissions;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function hasReportPermission() {
        return Permissions::isAuthorized('user');
    }

    public function hasModeratePermission() {
        return Permissions::isAuthorized('admin');
    }
}
