<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Private\Users\Trash\Modals\ModalPermanently;
use App\Components\Private\Users\Trash\Modals\ModalRecover;
use App\Components\Shared\Layouts\Table\Table;
?>

<div component="users:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Usuários excluídos",
                text: "Listagem de usuário no sistema excluídos",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 mx-4">
            <?= QuickActions::render(
                export: [
                    "entity" => "users/trash",
                    "excel" => true,
                    "pdf" => true
                ],
                actions: [
                    [
                        "text" => "Recuperar Usuários",
                        "class" => "bg-accent text-gray-100",
                        "attributes" => [
                            "recover" => 'users'
                        ]
                    ],
                    [
                        "text" => "Selecionar todos",
                        "class" => "bg-gray-300 active:scale-95",
                        "attributes" => [
                            "checked-settings" => 'all',
                            "target-table" => 'table_trash'
                        ]
                    ],
                ]
            ) ?>
            <?= Table::render(
                id: "table_trash",
                heads: ['id', 'name', 'status', 'email', 'role'],
                relations: ['id', 'name', 'status', 'email', 'roles.name'],
                ajax: '/api/users/trash',
                delete: "users/permanently",
                checked: true
            ) ?>
        </div>
    </div>
</div>
<?php

ModalRecover::render();
ModalPermanently::render();
?>