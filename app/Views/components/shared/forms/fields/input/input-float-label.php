<?php

use App\Components\Shared\Forms\Variants\CounterField\CounterField;

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="input mb-3" component="input">
    <div class="relative shadow-sm border-gray-200 border-2 rounded-md">
        <div class="w-100">
            <input type="<?= $type ?>"
                name="<?= $name ?>"
                value="<?= isset($value) ? $value : null ?>"
                id="<?= !empty($id) ? $id : $name ?>"
                data-label="<?= $label ?>"
                class="form-control w-100 h-[3rem] text-sm lg:text-md pl-2 pr-9 pt-4 rounded-sm outline-accent focus:outline-solid <?= $className ?? null ?>"
                <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= $maxLength > 0 && !empty($maxLength) ? "maxLength='$maxLength'" : null ?>
                <?= strval($readonly) ?? null ?>>
            <?php if (!isset($labelNot)) : ?>
                <label class="absolute left-1 top-20 pl-1 text-sm lg:text-lg text-black-300" data-label-toggle="true" component="input:label" for="<?= !empty($id) ? $id : $name ?>">
                    <strong class="font-arial">
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/variants/tooltip/required") : null ?>
                    </strong>
                </label>
            <?php endif; ?>
            <?php if (!empty($maxLength)):
                CounterField::render(
                    class: "top-5 right-2",
                    initial: isset($value) ? strlen($value) : 0,
                    max: isset($maxLength) ? $maxLength  : 0,
                    target: $name
                );
            endif; ?>
        </div>
        <?php if (isset($icon)) : ?>
            <div class="absolute right-0 top-0 h-full pt-2 pr-2">
                <div class="input-group-append text-xl w-[1.5rem] h-[1rem] text-accent">
                    <?= $icon ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>