<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Submit\Submit;

?>
<div component="profile:permissions" class="mt-8 pb-6">
    <form>
        <div class="form-row flex flex-wrap justify-between w-100">
            <div class="form-group w-47">

            </div>
        </div>

        <div class="w-30 mx-auto mt-6">
            <?= Submit::render(
                text: "Atualizar Permissões"
            ) ?>
        </div>
    </form>
</div>