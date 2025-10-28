<?php

declare(strict_types=1);

use App\Components\Private\Companies\Form\Information\Describe\Describe;
use App\Components\Private\Companies\Form\Information\Sidebar\Sidebar;

helper("json");

?>
<div component="company:form" class=" mt-8 pb-6">
    <form send='company'>
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