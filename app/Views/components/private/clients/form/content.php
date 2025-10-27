<?php

use App\Components\Private\Clients\Form\Information\Information;
use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Shared\Layouts\Tabs\Tabs;

?>

<div component="clients:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Formulário de clientes",
                text: "Gerencie suas informações de clientes",
                icon: '<i class="bi bi-person"></i>'
            );
            ?>
        </div>
        <div class="bg-content px-4 py-4 shadow my-2 mx-4">
            <?php
            Tabs::render(
                default: "Informações",
                contents: [
                    "Informações" => Information::render(
                        isReturn: true
                    )
                ]
            );
            ?>
        </div>
    </div>
</div>