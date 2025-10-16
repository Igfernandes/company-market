<?php

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Profile\Form;
use App\Components\Private\Profile\Permissions;
use App\Components\Shared\Layouts\Tabs\Tabs;

?>

<div component="profile:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Perfil do Usuário",
                text: "Gerencie suas informações de conta e preferências",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content px-4 py-4 shadow my-2 mx-4">
            <?php
            Tabs::render(
                default: "Informações",
                contents: [
                    "Informações" => Form::render(),
                    "Permissões" => Permissions::render(
                        userId: $id
                    )
                ]
            )
            ?>
        </div>
    </div>
</div>