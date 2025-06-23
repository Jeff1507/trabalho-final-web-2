<?php

namespace App\Facades;

class Permissions
{
    public static function loadPermissions($user_role)
    {
        session(['user_permissions' => [$user_role => true]]);
    }

    public static function isAuthorized($role)
    {
        $permissions = session('user_permissions');

        if (!is_array($permissions)) {
            return false;
        }

        return array_key_exists($role, $permissions);
    }

    public static function test()
    {
        return "<h1>PermissionsFacade - Running!!</h1>";
    }
}