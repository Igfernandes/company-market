<?php

declare(strict_types=1);

use App\Components\Shared\Utils\Exports\Exports;

/**
 * @var array{
 *  text: string,
 *  link: string,
 *  class: ?string ,
 *  attributes: ?array,   
 * } $actions
 * @var array{
 *  entity: string,
 *  excel: bool,
 *  pdf: bool
 * } $exports
 */

?>

<div component='quick-actions' class="relative z-10">
    <div class="flex justify-between my-4">
        <div>
            <div class="flex items-center flex-wrap md:flex-nowrap bg-content">
                <?php
                if (isset($actions)):
                    foreach ($actions as $action): ?>
                        <div <?= isset($action['attributes']) ? getAttributes($action['attributes']) : null ?> component='quick-actions:button' class="py-2 px-4 rounded-sm mr-3 cursor-pointer <?= $action['class'] ?>">
                            <a class="py-1 block" href="<?= isset($action['link']) ? $action['link'] : "#" ?>">
                                <strong> <?= $action['text'] ?></strong>
                            </a>
                        </div>
                <?php endforeach;
                endif; ?>
                <?php if (isset($trash) && !empty($trash)): ?>
                    <div class="mt-4 md:mt-0 w-full" component='quick-actions:button'>
                        <a href=" <?= $trash ?>" class="bg-red-100 block text-center md:text-left md:inline-block text-gray-800 py-3 px-8 rounded-sm shadow mr-3 cursor-pointer">
                            <i class="bi bi-trash"></i> <span>Lixeira</span>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <?php if (isset($export['entity']) && !empty($export['entity'])): ?>
            <?=
            Exports::render(
                entity: $export['entity'],
                excel: $export['excel'] ?: false,
                pdf: $export['pdf'] ?: false
            )
            ?>
        <?php endif; ?>
    </div>
</div>