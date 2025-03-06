<?php

if (!function_exists('permissionsManager')) {
    function permissionsManager($permission = '')
    {
        if (empty($permission)) return;

        $session = session();
        $userPermissions = $session->get("permissions");

        if (!isset($userPermissions) || !is_array($userPermissions)) {
        }

        foreach ($userPermissions as $userPermission) {
            if ($userPermission === $permission)
                return true;
        }

        return false;
    }
}
