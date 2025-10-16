<?php

namespace App\Components\Shared\Utils\Permissions;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;
use App\Database\Models\Permissions\PermissionsModel;

class Permissions extends BaseComponents
{
    const ORIGIN = "components/shared/utils/permissions";
    const PROPS = [
        'checked'
    ];

    public static function render(
        array $permissions  = [],
        array $checked = []
    ) {
        $permissionsModel = new PermissionsModel();
        $founds =  $permissionsModel->findAll();
        $props = self::PROPS;
        \array_push($props, 'permissions');
        $permissions = [];

        foreach ($founds as $permission) {
            if (!isset($permissions[$permission->getScope()]) || !is_array($permissions[$permission->getScope()]))
                $permissions[$permission->getScope()] = [];

            \array_push($permissions[$permission->getScope()], [
                "id" => $permission->getId(),
                "name" => lang("Permissions." . $permission->getName()),
            ]);
        }

        Modal::render(
            title: "Permissões",
            type: "permissions",
            content: Component(self::ORIGIN, compact($props), true),
            left: "Cancel",
            right: "Salvar"
        );
    }
}
