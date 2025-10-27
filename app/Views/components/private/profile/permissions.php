<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Checkbox\Checkbox;
use App\Components\Shared\Forms\Fields\Input\InputIcon\InputIcon;
use App\Components\Shared\Forms\Fields\Submit\Submit;

?>
<div component="profile:permissions" class="mt-8 pb-6">
    <form send='user-permissions'>
        <div class="form-row w-100">
            <?php if (isset($userId)): ?>
                <div class="hidden">
                    <?= InputIcon::render(
                        type: "hidden",
                        name: "userId",
                        value: strval($userId)
                    ); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3 bg-white p-2 rounded-sm">
                <div>
                    <p class="text-sm text-justify my-2 border-b-2 ">As permissões listadas abaixo serão vinculadas ao usuário.</p>
                </div>
                <div class="overflow-y-auto flex flex-wrap justify-around h-[40rem] px-5 py-2">
                    <?php if (isset($permissions) && is_array($permissions)):
                        foreach ($permissions as $scope => $permissionScope): ?>
                            <div class=" mb-4 border-2 border-theme py-2 px-4">
                                <div class="mb-1">
                                    <span class="text-md font-semibold"><u><?= lang("Words.$scope") ?></u></span>
                                </div>
                                <ul component='permissions:list'>
                                    <?php
                                    foreach ($permissionScope as $permission): ?>

                                        <li>
                                            <?= Checkbox::render(
                                                name: "permissions",
                                                value: strval($permission['id']),
                                                checked: isset($permission['checked']),
                                                label: lang("Permissions." . $permission['name']) .  $id
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

        <div class="w-30 mx-auto mt-6">
            <?= Submit::render(
                text: "Atualizar Permissões"
            ) ?>
        </div>
    </form>
</div>