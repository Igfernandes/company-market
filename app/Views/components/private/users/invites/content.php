<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Private\Users\Overview\Modals\DeleteModal;
use App\Components\Private\Users\Overview\Modals\InviteModal;
use App\Components\Shared\Layouts\Table\Table;
?>

<div component="users:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Convites enviados",
                text: "Listagem de convites enviados para novos usuários",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 md:mx-4">
            <?= QuickActions::render(
                actions: [
                    [
                        "text" => "+ Convidar Usuários",
                        "class" => "bg-accent text-gray-100 block w-100 md:w-[16rem] md:inline-block text-center",
                        "attributes" => [
                            "invite" => 'users'
                        ]
                    ],
                ]
            ) ?>
            <?= Table::render(
                id: "invites",
                heads: ['Id', 'Nome',  'E-mail', 'É Valido?', 'Expira em'],
                relations: ['id', 'name', 'email', 'is_valid', 'expired_at'],
                ajax: '/api/invites/user',
                delete: "users",
            ) ?>
        </div>
    </div>
</div>
<?php

InviteModal::render();
DeleteModal::render();
?>