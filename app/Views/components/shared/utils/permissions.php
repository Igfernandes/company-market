<?php

use App\Components\Shared\Forms\Fields\Checkbox\Checkbox;
?>

<div class="mb-3" component='permissions'>
    <div>
        <div>
            <h3 class="font-poppins">Gerenciador de Permissões</h3>
            <p class="text-sm text-justify my-2">As permissões listadas abaixo serão vinculadas à função escolhida. Todos os usuários atribuídos a essa função receberão automaticamente essas permissões.</p>
        </div>
        <div class="overflow-y-auto h-[10rem] px-3 py-2 border-2 border-theme">
            <?php if (isset($permissions) && is_array($permissions)):
                foreach ($permissions as $scope => $permissionScope): ?>
                    <div class="mb-4">
                        <div class="mb-1">
                            <span class="text-md font-semibold"><u><?= lang("Words.$scope") ?></u></span>
                        </div>
                        <ul component='permissions:list'>
                            <?php
                            foreach ($permissionScope as $permission): ?>

                                <li>
                                    <?= Checkbox::render(
                                        name: "permission[]",
                                        value: $permission['id'],
                                        label: $permission['name']
                                    ) ?>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
            <?php
                endforeach;
            endif; ?>
        </div>
    </div>
</div>