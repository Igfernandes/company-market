<?php

declare(strict_types=1);

use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Private\Users\Roles\Form;
use App\Components\Shared\Layouts\Table\Table;

?>

<div component="rules:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Funções do Usuário",
                text: "Listagem de funções de usuários",
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
                        id: "table_roles",
                        heads: ['Id', 'Nome', 'Descrição'],
                        relations: ['id', 'name', 'description'],
                        ajax: '/api/users/roles',
                        delete: "users/roles",
                        options: [
                            "update" => "Atualizar",
                            "permissions" => "Permissões"
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>