<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Private\Companies\Trash\Modals\ModalPermanently;
use App\Components\Private\Companies\Trash\Modals\ModalRecover;
use App\Components\Shared\Layouts\Table\Table;
?>

<div component="companies:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Empresas excluídas",
                text: "Listagem de empresas excluídas no sistema",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 mx-4">
            <?= QuickActions::render(
                export: [
                    "entity" => "companies/trash",
                    "excel" => true,
                    "pdf" => true
                ],
                actions: [
                    [
                        "text" => "Recuperar Empresas",
                        "class" => "bg-theme text-gray-100",
                        "attributes" => [
                            "recover" => 'companies'
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
                heads: ['Id', 'Nome', 'Status', 'CNPJ', 'Registrado em'],
                relations: ['id', 'name', 'status', 'document', 'created_at'],
                ajax: '/api/companies/trash',
                delete: "companies/permanently",
                checked: true
            ) ?>
        </div>
    </div>
</div>
<?php

ModalRecover::render();
ModalPermanently::render();
?>