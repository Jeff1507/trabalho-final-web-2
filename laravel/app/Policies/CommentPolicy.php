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

    public function hasCommentPermission() {
        return Permissions::isAuthorized('user');
    }

    public function hasReportPermission() {
        return Permissions::isAuthorized('user');
    }

    public function hasRemovePermission() {
        return Permissions::isAuthorized('admin');
    }

    public function hasValidatePermission() {
        return Permissions::isAuthorized('admin');
    }
}
