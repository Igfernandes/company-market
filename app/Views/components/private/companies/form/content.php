<?php

use App\Components\Private\Companies\Form\Information\Information;
use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Shared\Layouts\Tabs\Tabs;

?>

<div component="companies:content">
    <div>
        <div>
            <?php
            BreadcrumbHeader::render(
                title: "Formulário de Empresas",
                text: "Gerencie informações de empresas",
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