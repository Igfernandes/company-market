<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Clients\Categories\Form;
use App\Components\Shared\Layouts\Table\Table;

?>

<div component="rules:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Categorias de Clientes",
                text: "Listagem de categorias de clientes",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content text-left px-4 py-4 shadow my-2 mx-4">
            <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-100 md:w-30 mt-3">
                    <?= Form::render();  ?>
                </div>
                <div class="w-100 md:w-70 md:pl-8 mt-10 md:mt-0">
                    <?= Table::render(
                        id: "table_categories",
                        heads: ['Id', 'Nome', 'Descrição'],
                        relations: ['id', 'name', 'description'],
                        ajax: '/api/clients/categories',
                        delete: "clients/categories",
                        options: [
                            "update" => "Atualizar"
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>