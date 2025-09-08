<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Private\Users\Overview\InviteModal;
use App\Components\Shared\Layouts\Table\Table;
?>

<div component="users:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Usuários do sistema",
                text: "Listagem de usuário no sistema e suas informações",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 mx-4">
            <?= QuickActions::render(
                trash: "./users/trash",
                export: [
                    "entity" => "users",
                    "excel" => true,
                    "pdf" => true
                ],
                actions: [
                    [
                        "text" => "+ Convidar Usuários",
                        "class" => "bg-accent text-gray-100",
                        "attributes" => [
                            "invite" => 'users'
                        ]
                    ],
                ]
            ) ?>
            <?= Table::render(
                id: "users",
                heads: ['id', 'name', 'status', 'email', 'role'],
                relations: ['id', 'name', 'status', 'email', 'roles.name'],
                ajax: '/api/users',
                update: "/dashboard/users",
                delete: "users",
            ) ?>
        </div>
    </div>
</div>
<?= InviteModal::render(); ?>