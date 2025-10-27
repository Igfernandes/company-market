<?php

use App\Components\Private\Companies\Overview\Modals\DeleteModal\DeleteModal;
use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Layouts\QuickActions\QuickActions;
use App\Components\Shared\Layouts\Table\Table;

?>

<div component='companies:content'>
    <div>
        <div>
            <?php BreadcrumbHeader::render(
                title: "Empresas",
                text: "Listagem de empresas no sistema e suas informações",
                icon: '<i class="bi bi-person"></i>'
            ); ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 md:mx-4">
            <?= QuickActions::render(
                trash: "./companies/trash",
                export: [
                    "entity" => "companies",
                    "excel" => true,
                    "pdf" => true
                ],
                actions: [
                    [
                        "text" => "+ Criar Empresa",
                        "class" => "bg-theme text-gray-100 block w-full w-[24rem] md:inline-block text-center",
                        "link" => "/dashboard/companies/create"
                    ],
                ]
            ) ?>
            <?= Table::render(
                id: "companies",
                heads: ['Id', 'Nome', 'Status', 'CNPJ', 'Registrado em'],
                relations: ['id', 'name', 'status', 'document', 'created_at'],
                ajax: '/api/companies',
                update: "/dashboard/companies/form",
                delete: "companies",
            ) ?>
        </div>
    </div>
</div>
<?php
DeleteModal::render();
?>