<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Private\Clients\Trash\Modals\ModalPermanently;
use App\Components\Private\Clients\Trash\Modals\ModalRecover;
use App\Components\Shared\Layouts\Table\Table;
?>

<div component="clients:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Embarcações excluídas",
                text: "Listagem de clientes excluídos no sistema",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 mx-4">
            <?= QuickActions::render(
                export: [
                    "entity" => "clients/trash",
                    "excel" => true,
                    "pdf" => true
                ],
                actions: [
                    [
                        "text" => "Recuperar Clientes",
                        "class" => "bg-theme text-gray-100",
                        "attributes" => [
                            "recover" => 'clients'
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
                heads: ['Id', 'Nome', 'Status', 'Modelo', 'Registrado em'],
                relations: ['id', 'name', 'status', 'model', 'created_at'],
                ajax: '/api/clients/trash',
                delete: "clients/permanently",
                checked: true
            ) ?>
        </div>
    </div>
</div>
<?php

ModalRecover::render();
ModalPermanently::render();
?>