<?php

declare(strict_types=1);

use App\Components\Private\Clients\Form\Information\Describe\Describe;
use App\Components\Private\Clients\Form\Information\Sidebar\Sidebar;

helper("json");

?>
<div component="client:form" class=" mt-8 pb-6">
    <form send='client'>
        <div class="form-content flex flex-wrap justify-between">
            <div class="w-100 md:w-75">
                <?= Describe::render(); ?>
            </div>
            <div class="w-100 md:w-20">
                <?= Sidebar::render(
                    id: $id ?? null
                ); ?>
            </div>
        </div>
    </form>
</div>