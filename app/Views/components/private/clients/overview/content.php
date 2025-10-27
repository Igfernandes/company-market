<?php

use App\Components\Private\Clients\Overview\Modals\DeleteModal\DeleteModal;
use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Shared\Layouts\Table\Table;

?>

<div component='clients:content'>
    <div>
        <div>
            <?php BreadcrumbHeader::render(
                title: "Clientes",
                text: "Listagem de clientes no sistema e suas informações",
                icon: '<i class="bi bi-person"></i>'
            ); ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 md:mx-4">
            <?= QuickActions::render(
                trash: "./clients/trash",
                export: [
                    "entity" => "clients",
                    "excel" => true,
                    "pdf" => true
                ],
                actions: [
                    [
                        "text" => "+ Criar Clientes",
                        "class" => "bg-theme text-gray-100 block w-full w-[24rem] md:inline-block text-center",
                        "link" => "/dashboard/clients/create"
                    ],
                ]
            ) ?>
            <?= Table::render(
                id: "clients",
                heads: ['Id', 'Nome', 'Status', 'Celular', 'Registrado em'],
                relations: ['id', 'name', 'status', 'phone', 'created_at'],
                ajax: '/api/clients',
                update: "/dashboard/clients/form",
                delete: "clients",
            ) ?>
        </div>
    </div>
</div>
<?php
DeleteModal::render();
?>