<?php

use App\Components\Private\Companies\Form\Information\Information;
use App\Components\Private\Companies\Form\Integrations\Integrations;
use App\Components\Private\Layouts\BreadcrumbHeader\BreadcrumbHeader;
use App\Components\Shared\Layouts\Tabs\Tabs;

$tabs = [
    "Informações" => Information::render(
        isReturn: true
    )
];

if (isset($id)) {
    $tabs['Integrações'] = Integrations::render(
        isReturn: true
    );
}

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
                contents: $tabs
            );
            ?>
        </div>
    </div>
</div>