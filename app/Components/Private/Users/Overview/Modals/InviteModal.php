<?php

namespace App\Components\Private\Users\Overview\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class InviteModal extends BaseComponents
{
    const ORIGIN = "components/private/users/overview/modals/inviteModal";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "invite",
            title: "Convidar Usuário",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            right: "Convidar"
        );
    }
}
